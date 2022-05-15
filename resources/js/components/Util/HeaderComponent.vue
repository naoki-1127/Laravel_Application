<template>
     <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-1 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ name }}</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
                <button type="button" class="btn btn-outline-secondary">Share</button>
                <button type="button" class="btn btn-outline-secondary">Export</button>
            </div>
            <button type="button" class="btn btn-outline-secondary dropdown-toggle">
                <font-awesome-icon icon='calendar-week' />
                This week
            </button>
        </div>
    </div>
</template>

<script>

export default {
    props: ['name'],
    mounted() {
        console.log('Component mounted.')
    },
}
</script>
