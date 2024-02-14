<script setup>
import {ref, onMounted} from 'vue'
import IMask from 'imask';

const emit = defineEmits(['addedNewEmployee']);

const props = defineProps(['employeeForm', 'url', 'method']);

const form = ref(props.employeeForm);

function createEmployee() {
    const nonEmptyPhones = form.value.phones.filter(phone => phone.trim() !== '');

    axios[props.method](props.url, {
            'name': form.value.name,
            'surname': form.value.surname,
            'phones': nonEmptyPhones,
        }
    )
        .then((res) => {
            console.log('Employee created');
            emit('addedNewEmployee');
            form.value.name = '';
            form.value.surname = '';
            form.value.phones = [''];
            form.value.errors = [];
        })
        .catch(error => {
            form.value.errors = error.response.data.errors
            console.error(form.value.errors);
        });
}

function addPhoneField() {
    form.value.phones.push('');
    applyMask(form.value.phones.length - 1);
}

function removePhoneField(index) {
    if (form.value.phones.length > 1) {
        form.value.phones.splice(index, 1);
    }
}

function applyMask(index) {
    const phoneInput = document.getElementById(`phones${index}`);
    if (phoneInput) {
        IMask(phoneInput, {
            mask: '+{38}(000)000-00-00',
        });
    }
}

onMounted(() => {
    applyMask(0);
});
</script>

<template>
    <div class="form">
        <div class="form__head">
            <h2 class="form__title">Створити нового користувача</h2>
            <a @click.prevent="createEmployee"
               class="form__submit"
            >
                Зберегти
            </a>
        </div>
        <div class="form__wrapper">
            <div class="form__group">
                <input type="text" id="name" name="name" class="form-input form__input" placeholder=" "
                       v-model="form.name">
                <label for="name" class="form__label">Введіть ім'я</label>
            </div>
            <div class="text-red-600 mb-5" v-if="form.errors.name">{{ form.errors['name'][0]}}</div>
            <div class="form__group">
                <input type="text" id="surname" name="surname" class="form-input form__input" placeholder=" "
                       v-model="form.surname">
                <label for="surname" class="form__label">Введіть прізвище</label>
            </div>
            <div class="text-red-600 mb-5" v-if="form.errors.surname">{{ form.errors['surname'][0]}}</div>
            <div v-for="(phone, index) in form.phones" :key="index" class="form__phones form-phones">
                <div class="form__group form-phones__group">
                    <input
                        type="text"
                        :id="'phones' + index"
                        name="phones"
                        class="form-input form__input"
                        placeholder=" "
                        v-model="form.phones[index]">
                    <label :for="'phones' + index" class="form__label">Введіть номер телефону</label>
                </div>
                <div v-if="index === form.phones.length - 1" class="form-phones__icon form-phones__icon-yellow" @click.prevent="addPhoneField">
                    <i class="fa-solid fa-plus"></i>
                </div>
                <div v-if="form.phones.length > 1" class="form-phones__icon form-phones__icon-red"
                     @click.prevent="removePhoneField(index)">
                    <i class="fa-solid fa-minus"></i>
                </div>
            </div>
            <div class="text-red-600 mb-5" v-if="form.errors.phones">{{ form.errors['phones'][0]}}</div>
        </div>
    </div>
</template>

<style scoped lang="scss">
@import "/resources/scss/variables";

.form {
    max-width: 600px;
    width: 100%;
    margin: 0 auto;

    &__head {
        display: flex;
        margin-bottom: 20px;
    }

    &__title {
        font-size: 24px;
        margin-right: 40px;
    }

    &__wrapper {

    }

    &__group {
        width: 100%;
        position: relative;
        height: 45px;
        margin-bottom: 20px;

        &:last-child {
            margin-bottom: 0;
        }
    }

    &__input {
        font-size: 16px;
        border-radius: 5px;
        position: absolute;
        left: 0;
        top: 0;
        outline: none;
        transition: all 0.16s ease-in;
    }

    &__label {
        position: absolute;
        left: 1rem;
        top: 13px;
        padding: 0 0.5rem;
        cursor: text;
        transition: top 0.2s ease-in,
        left 0.2s ease-in,
        font-size 0.2s ease-in;
        background-color: $white;
        border-radius: 10px;
        color: $gray;
    }

    &__submit {
        font-weight: 700;
        text-decoration: none;
        display: block;
        padding: 10px 15px;
        border-radius: 5px;
        -webkit-user-select: none;
        transition: all 0.4s;
        font-size: 14px;
        letter-spacing: 1px;
        background-color: $yellow;
        color: $white;
        width: fit-content;
        height: fit-content;

        &:hover {
            background: $yellow-hover;
        }
    }

    &__phones {
        display: flex;
        gap: 20px;
        margin-bottom: 20px;
        align-items: center;
    }
}

.form-phones {
    &__icon {
        width: 35px;
        height: 35px;
        font-size: 20px;
        cursor: pointer;
        border-radius: 50%;
        display: block;
        transition: all 0.3s;

        i {
            width: 35px;
            height: 35px;
            text-align: center;
            vertical-align: sub;
        }
    }

    &__icon-yellow {
        display: block;
        background: $yellow;
        color: $white;

        &:hover {
            background: $yellow-hover;
        }
    }

    &__icon-red {
        background: #d2592e;

        &:hover {
            background: #f34d12;
        }
    }

    .form__group {
        margin-bottom: 0;
    }

    &:last-child {
        margin-bottom: 0;

        .form-phones__icon-yellow {
            display: block;
        }
    }
}

.form-input {
    display: block;
    border: 2px solid $gray-light;
    width: 100%;
    height: 45px;
    padding: 8px 10px;
    background-color: transparent;
    color: $black;

    &:focus {
        border-color: rgba($yellow, 0.2);
        outline: none;
    }
}

.form__input:focus ~ .form__label,
.form__input:not(:placeholder-shown).form__input:not(:focus) ~ .form__label {
    top: -10px;
    font-size: 12px;
}
</style>
