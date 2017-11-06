<div id="app">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="btn-group pull-left">
                    <h4 class="page-title"> <button type="button" class="btn btn-custom waves-effect waves-light" data-toggle="modal" data-target="#con-close-modal">Enviar para seleção</button></h4>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">

                <h4 class="m-t-0 header-title"><b>Responsive example</b></h4>
                <p class="text-muted font-14 m-b-30">
                    Responsive is an extension for DataTables that resolves that problem by optimising the
                    table's layout for different screen sizes through the dynamic insertion and removal of
                    columns from the table.
                </p>

                <table id="datatable-responsive"
                       class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
                       width="100%">
                    <thead>
                    <tr >
                        <th>First name</th>
                        <th>Last name</th>
                        <th>Position</th>
                        <th>Office</th>
                        <th>Age</th>
                        <th>Start date</th>
                        <th>Salary</th>
                        <th>Extn.</th>
                        <th>E-mail</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Tiger</td>
                        <td>Nixon</td>
                        <td>System Architect</td>
                        <td>Edinburgh</td>
                        <td>61</td>
                        <td>2011/04/25</td>
                        <td>$320,800</td>
                        <td>5421</td>
                        <td>t.nixon@datatables.net</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<!-- modal -->
<div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Enviar para seleção</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group" v-bind:class="{ 'has-error':  emailCheck  || (missingInput && attemptSubmit) }">
                            <label for="field-3" class="control-label">Email</label>
                            <input type="text" class="form-control form-control-warning" v-model="form.email" id="field-3" placeholder="Ex. ze@carioca.com.br">
                            <ul class="parsley-errors-list filled" id="parsley-id-19" v-if="attemptSubmit && missingInput"><li class="parsley-required">Este campo é requerido.</li></ul>
                            <ul class="parsley-errors-list filled" id="parsley-id-19" v-if="emailCheck"><li class="parsley-required">Digite um email válido.</li></ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancelar</button>
                <button type="button" v-on:click="salvar" class="btn btn-custom waves-effect waves-light" id="btnSave">Criar</button>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    Vue.http.headers.common['x-auth'] = '<?php print $this->session->token ?>';
    var vm = new Vue({
        el: '#app',
        data: {
            form: {
                email: ''
            },
            project: '<?php print $this->uri->segment(3) ?>',
            attemptSubmit: false,

        },
        mounted() {
            this.getClients();
        },
        methods: {

            getClients: function(){
                /*let url = 'http://localhost:3000/clients/'+this.form._project;

                this.$http.get(url).then(response => {
                    if(response.body.status === 200){
                        console.log(response.body);
                        this.project = response.body;
                    }
                });
                 */
            },
            salvar: function(){
                this.attemptSubmit = true;
                if (this.missingInput || this.emailCheck) return null;
                this.$http.post('http://localhost:3000/clients/'+this.project, JSON.stringify(this.form)).then(response => {
                    console.log('pass');
                    console.log(response.body);
                    switch (response.body.status){
                        case 401: window.location = '<?php print site_url('/login')?>'; break;
                        case 400: swal('Poxa', 'Ocorreu um problema, entre em contato com o suporte! Código do erro: SPH-400', 'error'); break;
                        case 200:
                            swal({
                                title: 'Tudo certo!',
                                text: '',
                                timer: 1000,
                                onOpen: function () {
                                    swal.showLoading()
                                }
                            }).then(
                                function () {},
                                // handling the promise rejection
                                function (dismiss) {
                                    if (dismiss === 'timer') {
                                        location.reload();
                                    }
                                }
                            );
                            break;
                        default:  swal('Poxa', 'Ocorreu um problema, entre em contato com o suporte! Código do erro: SPH-900', 'error'); break;
                    }
                })
            },
        },
        computed: {
            missingInput: function () {  return this.form.email === ''; },
            emailCheck: function () {
                if(this.form.email === '')
                    return false;
                var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return !re.test(this.form.email.trim());
            },
            getTitle: function(){
                return this.project === '' ? '' : this.project.project.title;
            }
        }
    });
</script>
