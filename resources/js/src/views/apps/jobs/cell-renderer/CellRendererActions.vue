<template>
    <div :style="{'direction': $vs.rtl ? 'rtl' : 'ltr'}">
        <feather-icon icon="EyeIcon" svgClasses="h-5 w-5 mr-4 hover:text-primary cursor-pointer" @click="viewRecord" />
        <feather-icon icon="Edit3Icon" svgClasses="h-5 w-5 mr-4 hover:text-primary cursor-pointer" @click="editRecord" />
        <feather-icon icon="Trash2Icon" svgClasses="h-5 w-5 hover:text-danger cursor-pointer" @click="confirmDeleteRecord" />
    </div>
</template>

<script>
    export default {
        name: 'CellRendererActions',
        methods: {
            viewRecord() {
                this.$router.push("/jobs/job_view/" + this.params.data.id).catch(() => {})
            },
            editRecord() {
                this.$router.push("/jobs/job_edit/" + this.params.data.id).catch(() => {})
            },
            confirmDeleteRecord() {
                this.$vs.dialog({
                    type: 'confirm',
                    color: 'danger',
                    title: `Confirm Delete`,
                    text: `You are about to delete "${this.params.data.job_ref}"`,
                    accept: this.deleteRecord,
                    acceptText: "Delete"
                })
            },
            deleteRecord() {
                this.$store.dispatch("jobManagement/removeRecord", this.params.data.id)
                .then(()   => { this.showDeleteSuccess() })
                .catch(err => { console.error(err)       })
            },
            showDeleteSuccess() {
                this.$vs.notify({
                    color: 'success',
                    title: 'Job Deleted',
                    text: 'The selected job was successfully deleted',
                    position:'top-right',
                })
            }
        }
    }
</script>
