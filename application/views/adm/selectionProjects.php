<div id="app">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="page-title">Projetos</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 click" v-for="proj in projects">
            <div class="panel panel-default" v-on:click="redirect(proj._id)">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ proj.title }} <span class="text-fd label label-default pull-right">{{proj.eventDate}}</span></h3>
                </div>
                <div class="panel-body" v-if="proj.photos[0]">
                    <img v-bind:src="proj.photos[0].path" class="img-responsive" alt="...">
                </div>
                <div class="panel-body" v-else>
                    <img src="<?php print site_url('assets/images/placeholder_project.jpg') ?>" class="img-responsive" alt="...">
                </div>
                <div class="panel-footer">
                    <h5>
                        <span class="text-fd label label-primary " ><i class="mdi mdi-information"></i> Aguardando Aprovação</span>
                    </h5>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    Vue.http.headers.common['x-auth'] = '<?php print $this->session->token ?>';
    var vm = new Vue({
        el: '#app',
        data: {
            form: {
                title: '',
                category: '',
                date: ''
            },
            projects: '',
            ren: '',
            attemptSubmit: false
        },
        mounted() {
            this.$http.get('http://localhost:3000/clients/projects').then(response => {
                if(response.body.status == 200)
                    this.projects = response.body.projects;
            });
        },
        methods: {
            redirect: function(id){
                window.location = '<?php print site_url('/selection/myEvent/')?>'+id;
            },
            salvar: function(){
                this.attemptSubmit = true;
                //console.log('submited ' + this.form.date);
                if (this.missingTitulo || this.missingCategoria) return null;
                this.$http.post('http://localhost:3000/clients/project/', JSON.stringify(this.form)).then(response => {
                    //console.log(response.body);
                    switch (response.body.status){
                        case 401: break; window.location = '<?php print site_url('/login')?>'; break;
                        case 400: swal('Poxa', 'Ocorreu um problema, entre em contato com o suporte! Código do erro: PRO-400', 'error'); break;
                        case 200: swal({
                            title: 'Tudo certo!',
                            text: 'Você será redirecionado.',
                            timer: 2000,
                            onOpen: function () {
                                swal.showLoading()
                            }
                        }).then(
                            function () {},
                            function (dismiss) {
                                if (dismiss === 'timer') {
                                    window.location = '<?php print site_url('/projects/view/')?>'+response.body.project._id;
                                }
                            }
                        );
                            break;
                        default:  swal('Poxa', 'Ocorreu um problema, entre em contato com o suporte! Código do erro: PRO-900', 'error'); break;
                    }
                })
            },
        },
        computed: {
            missingTitulo: function () { return this.form.title === ''; },
            missingCategoria: function () { return this.form.category === ''; },
        }
    });
</script>