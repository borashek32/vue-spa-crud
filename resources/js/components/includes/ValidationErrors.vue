<template>
    <div>

    </div>
</template>

<script>
export default {
    props: ['errors'],
    computed: {
        validationErrors() {
            let errors = Object.values(this.errors)
            errors = errors.flat()

            return errors
        }
    }
}
</script>
