<template>
    <Minimal>
        <h2 class="title">Rejestracja</h2>

        <form @submit.prevent="handleRegister" class="form">
            <label>
                Imię:
                <input type="text" v-model="name" required />
            </label>

            <label>
                Email:
                <input type="email" v-model="email" required />
            </label>

            <label>
                Hasło:
                <input type="password" v-model="password" required />
            </label>

            <label>
                Powtórz hasło:
                <input type="password" v-model="confirm" required />
            </label>

            <button type="submit">Zarejestruj się</button>

            <p v-if="error" class="error">{{ error }}</p>
        </form>
    </Minimal>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import Minimal from './layouts/Minimal.vue'

const name = ref('')
const email = ref('')
const password = ref('')
const confirm = ref('')
const error = ref('')
const router = useRouter()

const handleRegister = async () => {
    error.value = ''

    if (password.value !== confirm.value) {
        error.value = 'Hasła nie są takie same.'
        return
    }

    try {
        const res = await fetch('/api/register', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                name: name.value,
                email: email.value,
                password: password.value,
            }),
        })

        if (!res.ok) {
            const body = await res.json()
            throw new Error(body.message || 'Błąd rejestracji')
        }

        await router.push('/login')
    } catch (e) {
        error.value = e.message
    }
}
</script>

<style scoped>
.title {
    font-size: 1.5rem;
    font-weight: bold;
    margin-bottom: 1rem;
    text-align: center;
}

.form {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

input {
    width: 100%;
    padding: 0.5rem;
    border-radius: 6px;
    border: 1px solid #333;
    background: #1d1d2b;
    color: var(--text-color);
}

button {
    padding: 0.6rem;
    background: var(--button-bg);
    border: none;
    border-radius: 6px;
    color: white;
    cursor: pointer;
    font-weight: bold;
}

.error {
    color: red;
    text-align: center;
}
</style>
