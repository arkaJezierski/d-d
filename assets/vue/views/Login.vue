<template>
    <Minimal>
        <h2 class="title">Logowanie</h2>

        <form @submit.prevent="handleLogin" class="form">
            <label>
                Email:
                <input type="email" v-model="email" required />
            </label>

            <label>
                Hasło:
                <input type="password" v-model="password" required />
            </label>

            <button type="submit">Zaloguj się</button>

            <p v-if="error" class="error">{{ error }}</p>
        </form>
    </Minimal>
</template>

<script setup>
import { ref } from 'vue'
import Minimal from "./layouts/Minimal.vue";
import { useRouter } from 'vue-router'

const email = ref('')
const password = ref('')
const error = ref('')
const router = useRouter()

const handleLogin = async () => {
    error.value = ''
    try {
        const res = await fetch('/api/login', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ email: email.value, password: password.value }),
        })

        if (!res.ok) {
            throw new Error('Nieprawidłowy login lub hasło')
        }

        await router.push('/play')
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
