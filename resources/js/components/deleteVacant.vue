<template>
    <button class="text-red-600 hover:text-red-900 mr-5" @click="deleteVacant">Delete</button>
</template>

<script>
    export default {
        props: ['vacantId'],
        methods: {
            deleteVacant() {
                this.$swal.fire({
                    title: '¿You want to delete this vacant?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {

                        const params = {
                            id: this.vacantId,
                            _method: 'delete'
                        }
                        // Send request to axios
                        axios.post(`/vacancies/${this.vacantId}`, params)
                        .then(answer => {
                            this.$swal.fire(
                                'Vacant Eliminated!',
                                answer.data.message,
                                'success'
                            );

                            // Delete DOM
                            this.$el.parentNode.parentNode.parentNode.removeChild(this.$el.parentNode.parentNode);
                        })
                        .catch(error => {
                            console.log(error);
                        })
                    }
                })
            }
        }
    }
</script>
