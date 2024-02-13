<script setup>
import Pagination from "../Components/Pagination.vue";
import {ref, onMounted} from 'vue'
import Form from "../Components/Form.vue";

const employees = ref([]);
const total = ref();
const currentPage = ref();
const perPage = ref();

function getEmployees() {
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

function showNewPage(page) {
    currentPage.value = page
    getEmployees()
}

onMounted(() => {
    getEmployees();
});
</script>

<template>
    <section class="employees">
        <div class="container">
            <div class="employees__form">
                <Form/>
            </div>

            <table id="customers">
                <tr>
                    <th>Name</th>
                    <th>Surname</th>
                    <th>Phone</th>
                </tr>
                <tr v-for="employee in employees">
                    <td>{{ employee.name }}</td>
                    <td>{{ employee.surname }}</td>
                    <td><span v-for="phone in employee.phones">0{{ phone }}; </span></td>
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
