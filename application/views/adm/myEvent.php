<style>
    footer {
        position: fixed;
        height: 50px;
        bottom: 50px;
        width: 100%;
        text-align: right;
    }
</style>
<div id="app">
    <div class="row">
        <div class="col-sm-12">
            <div class="row" v-if="project.folders">
                <div class="col-md-3 click" v-for="folder in project.folders.folders" v-on:click="redirect(folder._id)">
                    <div class="thumbnail">
                        <img src="<?php print site_url('assets/images/small/img-4.jpg')?>" class="img-responsive">
                        <div class="caption">
                            <h4>{{ folder.name }}<span class="pull-right">39 fotos</span></h4>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
<footer class="fixed-bottom"  style="background:white;">
    <div class="row">
        <div class="col-sm-12 col-offset-md-6 col-md-6">
            Total de fotos para seleção: 90
            fotos selecionadas: 32
            <button type="button" class="btn btn-custom waves-effect waves-light">Finalizar Seleção</button>
        </div>
    </div>
</footer>
<script type="text/javascript">
    Vue.http.headers.common['x-auth'] = '<?php print $this->session->token ?>';
    var vm = new Vue({
        el: '#app',
        data: {
            form: {

            },
            project: '',
            attemptSubmit: false,
            folder: '<?php print $this->uri->segment(4) ?>'
        },
        mounted() {
            this.getProject();
        },
        methods: {
            getProject: function () {
                let url = 'http://localhost:3000/projects/' + this.form._project + '/' + this.folder;
                console.log(url);
                this.$http.get(url).then(response => {
                    if (response.body.status === 200) {
                        console.log(response.body);
                        this.project = response.body;
                    }
                });
            }
        }
    });
</script>