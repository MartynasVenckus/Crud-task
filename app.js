let app = new Vue({
    el: '#crudApp',
    data: {
        allData: '',
        MyModal: false,
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
        },
        openModal() {
            app.date = '';
            app.client = '';
            app.license_plate = '';
            app.actionButton = 'Pridėti';
            app.dynamicTitle = 'Pridėti užsakymą';
            app.MyModal = true;
        },
        submitData() {
            if (app.date != '' && app.client != '' && app.license_plate != '') {
                if (app.actionButton == 'Pridėti') {
                    axios.post('action.php', {
                        action: 'insert',
                        date: app.date,
                        client: app.client,
                        licensePlate: app.license_plate
                    }).then(res => {
                        app.MyModal = false;
                        app.fetchAllData();
                        app.date = '';
                        app.client = '';
                        app.license_plate = '';
                        alert(res.data.message);
                        window.location.reload();
                    })
                }
            }
        },
    },

    created() {
        this.fetchAllData();
    }
})