let app = new Vue({
    el: '#crudApp',
    data: {
        allData: '',
        myModal: false,
        hiddenId: null,
        actionButton: 'Insert',
        dynamicTitle: 'Add data'
    },
    methods: {
        fetchAllData() {
            axios.post('action.php', {
                action: 'fetchall'
            }).then(res => {
                app.allData = res.data;
            })
        }
    },
    created() {
        this.fetchAllData();
    }
})