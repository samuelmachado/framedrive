<div id="app">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="btn-group pull-left">
                    <h4 class="page-title" >{{ this.getTitle }}</h4><br>
                    <h4 class="page-title"><button type="button" class="btn btn-custom waves-effect waves-light" data-toggle="modal" data-target="#con-close-modal">Nova Pasta</button>| <button type="button" v-on:click="upload" class="btn btn-inverse waves-effect w-md waves-light">Upload</button></h4>

                </div>
                <div class="btn-group pull-right">
                    broadcumb <a href="<?php print site_url('selection/view/'.$this->uri->segment(3));?>">Área de Seleção</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row" v-if="project.folders">
        <div class="col-md-3 click" v-for="folder in project.folders.folders" v-on:click="redirect(folder._id)">
            <div class="thumbnail">
                <img src="<?php print site_url('assets/images/small/img-4.jpg')?>" class="img-responsive">
                <div class="caption">
                    <h4>{{ folder.name }}<span class="pull-right">39 fotos</span></h4>
                </div>
            </div>
        </div>

    <!-- modal -->
    <div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Nova Pasta</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12"> <!-- attemptSubmit && (missingFolder || existsFolderCheck  -->
                            <div class="form-group" v-bind:class="{ 'has-error':  existsFolderCheck  || (missingFolder && attemptSubmit) }">
                                <label for="field-3" class="control-label">Nome da Pasta</label>
                                <input type="text" class="form-control form-control-warning" v-model="form.folder" id="field-3" placeholder="Ex. Festa">
                                <ul class="parsley-errors-list filled" id="parsley-id-19" v-if="attemptSubmit && missingFolder"><li class="parsley-required">Este campo é requerido.</li></ul>
                                <ul class="parsley-errors-list filled" id="parsley-id-19" v-if="existsFolderCheck"><li class="parsley-required">Já existe uma pasta com esse nome.</li></ul>
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
</div>
<script type="text/javascript">
    Vue.http.headers.common['x-auth'] = '<?php print $this->session->token ?>';
    var vm = new Vue({
        el: '#app',
        data: {
            form: {
                folder: '',
                _project: '<?php print $this->uri->segment(3) ?>',
                folderAbove: '<?php print $this->uri->segment(4) ?>'
            },
            project: '',
            attemptSubmit: false,
            folder: '<?php print $this->uri->segment(4) ?>'
        },
        mounted() {
            this.getProject();
        },
        methods: {
            upload: function(){
                window.location = '<?php print site_url('/projects/upload/'); ?>'+this.project.project._id+'/'+this.folder;
            },

            redirect: function(projectId){
                window.location = '<?php print site_url('/projects/view/'); print $this->uri->segment(3).'/'; ?>'+projectId;
            },
            getProject: function(){
                let url = 'http://localhost:3000/projects/'+this.form._project+'/'+this.folder;
                console.log(url);
                this.$http.get(url).then(response => {
                    if(response.body.status === 200){
                        console.log(response.body);
                        this.project = response.body;
                    }
                });
            },
            salvar: function(){
                this.attemptSubmit = true;
                if (this.missingFolder || this.emailCheck) return null;


                this.$http.post('http://localhost:3000/projects/folder', JSON.stringify(this.form)).then(response => {
                    switch (response.body.status){
                        case 401: break; window.location = '<?php print site_url('/login')?>'; break;
                        case 400: swal('Poxa', 'Ocorreu um problema, entre em contato com o suporte! Código do erro: PRVI-400', 'error'); break;
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
                        default:  swal('Poxa', 'Ocorreu um problema, entre em contato com o suporte! Código do erro: PRVI-900', 'error'); break;
                    }
                })
            },

        },
        computed: {
            missingFolder: function () {  return this.form.folder === ''; },
            emailCheck: function () {
                if(this.form.folder.trim() === '' || this.project === '') return false;
                for(var i = 0; i < this.project.folders.length; i++){
                    if (this.project.folders[i].name === this.form.folder.trim()){
                        return true;
                    }
                }
                return false;
            },
            getTitle: function(){
                return this.project === '' ? '' : this.project.project.title;
            }
        }
    });
</script>