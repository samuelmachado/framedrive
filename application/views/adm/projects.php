<div id="app">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="btn-group pull-right">
                    <button type="button" class="btn btn-custom waves-effect waves-light" data-toggle="modal" data-target="#con-close-modal">Novo Projeto</button>
                </div>
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

                    <h5><span class="text-fd label label-primary " ><i class="mdi mdi-information"></i> Aguardando Aprovação</span>
                        <small class="text-muted pull-right">Última atualização {{ suamae(proj._updatedAt) }}</small>
                    </h5>

                </div>
            </div>
        </div>
    </div>


    <div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Novo Projeto</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group" v-bind:class="{ 'has-error': attemptSubmit && missingTitulo }">
                                <label for="field-3" class="control-label">Título do Projeto</label>
                                <input type="text" class="form-control form-control-warning" v-model="form.title" id="field-3" placeholder="Ex. Maria & José">
                                <ul class="parsley-errors-list filled" id="parsley-id-19" v-if="attemptSubmit && missingTitulo"><li class="parsley-required">Este campo é requerido.</li></ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group"  v-bind:class="{ 'has-error': attemptSubmit && missingCategoria }">
                                <label for="field-4" class="control-label">Categoria</label>
                                <select name="" v-model="form.category" class="form-control" id="">
                                    <option value="">-- SELECIONE --</option>
                                    <option value="Casamento">Casamento</option>
                                    <option value="Love Story">Love Story</option>
                                    <option value="Corporativo">Corporativo</option>
                                    <option value="Festa Infantil">Festa Infantil</option>
                                    <option value="Formatura">Formatura</option>
                                    <option value="novo">Novo +</option>
                                </select>
                                <ul class="parsley-errors-list filled" id="parsley-id-19" v-if="attemptSubmit && missingCategoria"><li class="parsley-required">Este campo é requerido.</li></ul>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exemplo" class="control-label">Data do Evento</label>
                                <input type="text" class="form-control date datepicker" onchange="c(this.value)" v-model="form.date" maxlength="10"  placeholder="Ex. 10/10/2020">
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
    </div><!-- /.modal -->
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
            img: 'http://www.ericorocha.com.br/wp-content/themes/ericoBlog/images/erico_rocha.png',
            attemptSubmit: false
        },
        mounted() {
            this.$http.get('http://localhost:3000/projects').then(response => {
                if(response.body.status == 200)
                    this.projects = response.body.projects;
                //console.log();
            });
        },
        methods: {
            suamae: function(update){
                var oneDay = 24*60*60*1000;
                var firstDate = new Date(update);
                var secondDate = new Date('2017-09-29');
                var diffDays = Math.round(Math.abs((firstDate.getTime() - secondDate.getTime())/(oneDay)));
                if  (diffDays === 0)
                    return 'hoje';
                if (diffDays === 1)
                    return 'ontem';
                return diffDays + ' dias atrás';
            },
            redirect: function(id){
                window.location = '<?php print site_url('/projects/view/')?>'+id;
            },
            salvar: function(){
                this.attemptSubmit = true;
                //console.log('submited ' + this.form.date);
                if (this.missingTitulo || this.missingCategoria) return null;
                this.$http.post('http://localhost:3000/projects', JSON.stringify(this.form)).then(response => {
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
    function c(val){
        vm.form.date = val;
    }
</script>