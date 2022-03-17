<template>
    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full " :class="classStatusVacant()" @click="changeStatus" :key="statusVacantData">{{ statusVacant }}</span>
</template>

<script>
    export default {
        props:['status', 'vacantId'],
        mounted() {
            this.statusVacantData = Number(this.status)
        },
        data: function() {
            return {
                statusVacantData: null
            }
        },
        methods: {
            classStatusVacant() {
                return this.statusVacantData === 1 ? "bg-green-100 text-green-800" : "bg-red-100 text-red-800"
            },
            changeStatus() {
                if(this.statusVacantData === 1) {
                    this.statusVacantData = 0;
                } else {
                    this.statusVacantData = 1;
                }

                // Send axios
                const params = {
                    status: this.statusVacantData
                }
                axios.post('/vacancies/' + this.vacantId, params)
            }
        },
        computed: {
            statusVacant() {
                return this.statusVacantData === 1 ? 'Active' : 'Inactive'
            }
        }
    }
</script>
