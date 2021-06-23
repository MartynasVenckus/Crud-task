<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Užsakymų valdymo sistema</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
</head>
<body>
    <div class="container mt-5" id="crudApp">
      <h4 class="text-center mb-5">Užsakymų valdymo sistema</h3>

      <div class="table-responsive">
        <table class="table">
            <tr class="text-primary">
                <th>Užsakymo Nr.</th>
                <th>Data</th>
                <th>Klientas</th>
                <th>Paskutinis užsakymas</th>
                <th>Vilkiko nr.</th>
                <th> <button type="button" class="text-primary bg-transparent border-0" data-bs-toggle="modal" data-bs-target="#MyModal" @click="openModal" value="Add"> <i class="fa fa-plus fa-lg" aria-hidden="true"></i> </button> </th>
            </tr>
            <tr v-for="row in allData">
                <td>{{ row.orderNumber }}</td>
                <td>{{ row.date }}</td>
                <td>{{ row.client }}</td>
                <td>paskutinis užsakymas1</td>
                <td>{{ row.truckLicensePlate }}</td>
                <td>
                    <button type="button" name="edit" class="text-secondary bg-transparent border-0" data-bs-toggle="modal" data-bs-target="#MyModal"><i class="fa fa-pencil fa-lg" aria-hidden="true"></i> </button>
                    <button type="button" name="delete" class="text-secondary bg-transparent border-0" data-bs-toggle="modal" data-bs-target="#MyModal"> <i class="fa fa-trash-o fa-lg" aria-hidden="true"></i> </button>
                </td>
            </tr>
        </table>
      </div>

      <div v-if="MyModal" class="modal fade" id="MyModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ dynamicTitle }}</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="MyModal=false"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="date">Data</label>
                        <input type="date" v-model="date" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="client">Klientas</label>
                        <input type="text" v-model="client" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="license_plate">Vilkiko nr.</label>
                        <input type="text" v-model="license_plate" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" v-model="hiddenId">
                    <input type="button" v-model="actionButton" @click="submitData" class="btn btn-success">
                </div>
            </div>

        </div>
      
      </div>

        


    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="app.js"></script>
</body>
</html>