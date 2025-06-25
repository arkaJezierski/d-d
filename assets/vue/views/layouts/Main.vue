<template>
    <div class="layout-main">
        <header>
            <h1>D&D App</h1>
        </header>

        <div class="content">
            <aside>
                <router-link to="/">Start</router-link>
                <router-link to="/play">Zagraj</router-link>
            </aside>

            <main>
                <slot />
            </main>
        </div>

        <footer>
            &copy; {{ new Date().getFullYear() }} D&D Story Engine
        </footer>
    </div>
</template>
