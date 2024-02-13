<script setup>
import {ref, onMounted} from 'vue'

const form = ref({
    name: '',
    surname: '',
    phones: [],
    errors: [],
});

function createEmployee() {
    axios.post('/api/employees', {
            'name': form.value.name,
            'surname': form.value.surname,
            'phones': form.value.phones,
        }
    )
        .then((res) => {
            console.log(res.data);
            console.log('Employee created');
        })
        .catch(error => {
            form.value.errors = error.response.data.errors
            console.error(form.value.errors);
        });
}
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
                <input type="text" id="name" name="name" class="form-input form__input" placeholder=" " v-model="form.name">
                <label for="name" class="form__label">Введіть ім'я</label>
            </div>
            <div class="form__group">
                <input type="text" id="surname" name="surname" class="form-input form__input" placeholder=" "
                       v-model="form.surname">
                <label for="surname" class="form__label">Введіть прізвище</label>
            </div>
            <div class="form__phones">
                <div class="form__group">
                    <input type="text" id="phones" name="phones" class="form-input form__input" placeholder=" "
                           v-model="form.phones[0]">
                    <label for="phones" class="form__label">Введіть номер телефону</label>
                </div>
                <div class="form__submit form__phones-icon">+</div>
            </div>
        </div>
        <div style="font-size: 16px; color: red; margin-bottom: 20px;" v-for="(error, field) in errors"
             :key="field">
            {{ form.errors[0] }}
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
        &-icon {
            font-size: 30px;
            align-items: center;
            display: flex;
            width: 45px;
            height: 45px;
            justify-content: center;
            padding: 0;
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
