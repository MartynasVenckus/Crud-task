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
                if (app.actionButton == 'Redaguoti') {
                    axios.post('action.php', {
                        action: 'update',
                        date: app.date,
                        client: app.client,
                        licensePlate: app.license_plate,
                        hiddenId: app.hiddenId
                    }).then(res => {
                        app.MyModal = false;
                        app.fetchAllData();
                        app.date = '';
                        app.client = '';
                        app.license_plate = '';
                        app.hiddenId = '';
                        alert(res.data.message);
                        window.location.reload();
                    })
                }
            }
        },
        fetchData(id) {
            axios.post('action.php', {
                action: 'fetchSingle',
                id: id
            }).then(res => {
                app.date = res.data.date;
                app.client = res.data.client;
                app.license_plate = res.data.license_plate;
                app.hiddenId = res.data.id;
                app.MyModal = true;
                app.actionButton = "Redaguoti";
                app.dynamicTitle = "Redaguoti užsakymą";

            })
        },
        deleteData(id) {
            if (confirm("Ar tikrai norite pašalinti užsakymą")) {
                axios.post('action.php', {
                    action: 'delete',
                    id: id
                }).then(res => {
                    app.fetchAllData();
                    alert(res.data.message);
                });
            }
        }
    },

    created() {
        this.fetchAllData();
    }
})