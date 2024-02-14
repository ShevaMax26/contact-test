<script setup>
import Pagination from "../Components/Pagination.vue";
import {ref, onMounted} from 'vue'
import Form from "../Components/Form.vue";

const employees = ref([]);
const total = ref();
const currentPage = ref(1);
const perPage = ref();

function getEmployees() {
    replaceParamInUrl()

    axios.get('/api/employees', {
        params: {
            page: currentPage.value,
        }
    })
        .then((res) => {
            employees.value = res.data.employees;
            total.value = res.data.total;
            currentPage.value = res.data.currentPage;
            perPage.value = res.data.perPage;
            console.log(employees.value);
            console.log(total.value);
            console.log(perPage.value);
            console.log(currentPage.value);
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
}

function deleteEmployee(id) {
    axios.delete(`/api/employees/${id}`)
        .then((res) => {
            getEmployees()
            console.log('Record deleted successfully', res);
        })
        .catch((error) => {
            console.error('Error deleting record', error);
        });
}

function showNewPage(page) {
    currentPage.value = page
    getEmployees()
}

function replaceParamInUrl() {
    const currentUrl = new URL(window.location.href);
    const params = currentUrl.searchParams;

    if (currentPage.value) {
        params.set('page', currentPage.value);
    }

    currentUrl.search = params.toString();
    const updatedUrl = currentUrl.toString();
    window.history.replaceState({}, '', updatedUrl);
}

function setParamsFromUrl() {
    const currentUrl = new URL(window.location.href);
    const params = currentUrl.searchParams;

    if (params.get('page')) {
        currentPage.value = params.get('page');
    }
}

onMounted(() => {
    setParamsFromUrl();
    getEmployees();
});
</script>

<template>
    <section class="employees">
        <div class="container">
            <div class="employees__form">
                <Form @added-new-employee="getEmployees"/>
            </div>

            <table id="customers" class="mb-6">
                <tr>
                    <th>Name</th>
                    <th>Surname</th>
                    <th>Phone</th>
                    <th>Actions</th>
                </tr>
                <tr v-for="employee in employees">
                    <td>{{ employee.name }}</td>
                    <td>{{ employee.surname }}</td>
                    <td><span v-for="phone in employee.phones">+{{ phone }}; </span></td>
                    <td>
                        <div class="flex gap-4">
                            <i class="fa-solid fa-pen-to-square hover:text-blue-500 cursor-pointer"></i>
                            <i @click.prevent="deleteEmployee(employee.id)" class="fa-solid fa-trash-can hover:text-red-500 cursor-pointer"></i>
                        </div>
                    </td>
                </tr>
            </table>
            <div class="flex justify-around">
                <Pagination :total="total"
                            :current-page="currentPage"
                            :per-page="perPage"
                            @show-page="showNewPage"
                />
            </div>
        </div>
    </section>
</template>

<style scoped lang="scss">
#customers {
    font-family: Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

#customers td, #customers th {
    border: 1px solid #ddd;
    padding: 8px;
}

#customers tr:nth-child(even) {
    background-color: #f2f2f2;
}

#customers tr:hover {
    background-color: #ddd;
}

#customers th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #04AA6D;
    color: white;
}

.employees {
    &__form {
        border: 1px solid #e6e6e6;
        border-radius: 5px;
        box-shadow: 0 0 5px 0.5px rgba(0, 0, 0, 0.1);
        background-color: #fff;
        padding: 30px;
        margin-bottom: 20px;
    }
}
</style>
