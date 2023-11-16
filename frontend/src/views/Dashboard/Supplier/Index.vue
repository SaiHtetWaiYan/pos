<template>
  <div>
    <div class="px-4 sm:px-6 lg:px-8">
      <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
          <h1 class="text-xl font-semibold text-gray-900">Suppliers</h1>
          <p class="mt-2 text-sm text-gray-700">
            A list of all the suppliers in your account created name and
            contact.
          </p>
        </div>

        <Create @passData="getData"></Create>
      </div>

      <div class="grid grid-cols-6 gap-6 mt-6">
        <div class="col-span-6 sm:col-span-2">
          <label for="search" class="block text-sm font-medium text-gray-700"
            >Search by name</label
          >
          <input
            type="text"
            name="search"
            id="search"
            v-model="search"
            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
          />
        </div>
        <div class="col-span-6 sm:col-span-2">
          <label for="per-page" class="block text-sm font-medium text-gray-700"
            >Per page</label
          >
          <select
            id="per-page"
            name="per-page"
            v-model="per_page"
            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
          >
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
          </select>
        </div>
        <div class="col-span-6 sm:col-span-2">
          <label for="trash" class="block text-sm font-medium text-gray-700"
            >Trash</label
          >
          <select
            id="trash"
            name="trash"
            v-model="trashed"
            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
          >
            <option :value="null" />
            <option value="with">With Trashed</option>
            <option value="only">Only Trashed</option>
          </select>
        </div>
      </div>

      <div class="mt-8 flex flex-col">
        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div
            class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8"
          >
            <div
              class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg"
            >
              <table class="min-w-full divide-y divide-gray-300">
                <thead class="bg-gray-50">
                  <tr>
                    <th
                      scope="col"
                      class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6"
                    ></th>
                    <th
                      scope="col"
                      class="px-4 py-3.5 text-left text-sm font-semibold text-gray-900"
                    >
                      Name
                    </th>
                    <th
                      scope="col"
                      class="py-3.5 text-left text-sm font-semibold text-gray-900"
                    >
                      Contact
                    </th>
                    <th scope="col" class="relative py-3.5 pr-4 sm:pr-6">
                      <span class="sr-only">Action</span>
                    </th>
                  </tr>
                </thead>
                <tbody class="bg-white">
                  <tr
                    v-for="(supplier, supplierIdx) in suppliers.data"
                    :key="supplier.id"
                    :class="supplierIdx % 2 === 0 ? undefined : 'bg-gray-50'"
                  >
                    <td
                      class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-500 sm:pl-6"
                    >
                      {{
                        supplierIdx +
                        1 +
                        suppliers.current_page * suppliers.per_page -
                        suppliers.per_page
                      }}
                    </td>
                    <td
                      class="whitespace-nowrap px-4 py-4 text-sm text-gray-500"
                    >
                      {{ supplier.name }}
                    </td>
                    <td class="whitespace-nowrap py-4 text-sm text-gray-500">
                      {{ supplier.contact }}
                    </td>
                    <td
                      class="flex whitespace-nowrap py-4 text-right text-sm font-medium sm:pr-6 justify-end"
                    >
                      <Edit :supplier="supplier" @passData="getData"></Edit>
                      <RestoreModal
                        :restore="supplier"
                        :page="'supplier'"
                        @passData="getData"
                        v-if="supplier.deleted_at"
                      ></RestoreModal>
                      <DeleteModal
                        :delete="supplier"
                        :page="'supplier'"
                        @passData="getData"
                        v-else
                      ></DeleteModal>
                    </td>
                  </tr>
                  <tr v-if="suppliers.total === 0">
                    <td
                      class="px-6 py-4 whitespace-nowrap border-b border-gray-200 text-center"
                      colspan="4"
                    >
                      No suppliers found.
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="flex items-center justify-center p-8">
        <v-pagination
          v-model="page"
          :pages="pageCount"
          :range-size="1"
          active-color="#DCEDFF"
          @update:modelValue="fetchdata"
        />
      </div>
    </div>
    <aside
      v-if="msg"
      class="fixed bottom-4 right-4 z-50 flex items-center justify-center gap-4 rounded-lg bg-green-400 px-5 py-3 text-white"
    >
      <span class="text-sm font-medium hover:opacity-75">
        Hey! {{ msg }} 👋
      </span>
    </aside>
  </div>
</template>

<script>
import { ref } from "vue";
import axiosInstance from "@/axios.js";
import VPagination from "@hennge/vue3-pagination";
import "@hennge/vue3-pagination/dist/vue3-pagination.css";
import Create from "@/views/Dashboard/Supplier/Create.vue";
import Edit from "@/views/Dashboard/Supplier/Edit.vue";
import DeleteModal from "@/components/Dashboard/DeleteModal.vue";
import RestoreModal from "@/components/Dashboard/RestoreModal.vue";
export default {
  components: {
    VPagination,
    Create,
    Edit,
    DeleteModal,
    RestoreModal,
  },
  data() {
    let suppliers = ref([]);
    return {
      suppliers,
      page: 1,
      pageCount: null,
      search: null,
      per_page: ref("10"),
      trashed: null,
      msg: ref(null),
    };
  },
  mounted() {
    this.fetchdata();
  },
  watch: {
    search(after, before) {
      this.fetchdata();
    },
    per_page(after, before) {
      this.fetchdata();
    },
    trashed(after, before) {
      this.fetchdata();
    },
  },
  methods: {
    async fetchdata() {
      const response = await axiosInstance.post(
        "/api/supplier?page=" + this.page,
        {
          search: this.search,
          perpage: this.per_page,
          trashed: this.trashed,
        }
      );
      this.suppliers = response.data.suppliers;
      this.pageCount = response.data.suppliers.last_page;
    },
    getData(value) {
      this.fetchdata();
      this.msg = value;
      this.alert();
    },
    alert() {
      setTimeout(() => {
        this.msg = null;
      }, 3000);
    },
  },
};
</script>
