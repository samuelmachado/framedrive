
<!DOCTYPE html>
<!--suppress ALL -->
<html>

<head>
    <?php $this->load->view('adm/top')?>
</head>


<body class="bg-accpunt-pages">
<div id="app">
    <!-- HOME -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">

                    <div class="wrapper-page">

                        <div class="account-pages">
                            <div class="account-box">
                                <div class="account-logo-box">
                                    <h2 class="text-uppercase text-center">
                                        <a href="index.html" class="text-success">
                                            <span><img src="assets/images/logo_dark.png" alt="" height="30"></span>
                                        </a>
                                    </h2>
                                    <p class="m-b-0">Antes de prosseguir para seleção, cadastre uma senha</p>
                                </div>

                                <div class="account-content">
                                    <form class="form-horizontal" action="#">
                                        <div class="form-group m-b-20">
                                            <div class="col-xs-12">
                                                <label for="password">Senha</label>
                                                <input class="form-control" name="password" type="password" required="" id="password" placeholder="Digite sua senha" v-model="form.password">
                                            </div>
                                        </div>
                                        <div class="form-group m-b-20">
                                            <div class="col-xs-12">
                                                <label for="password">Repita a senha</label>
                                                <input class="form-control" name="password2" type="password" required="" id="password2" placeholder="Repita sua senha" v-model="form.password2">
                                            </div>
                                        </div>

                                        <div class="form-group text-center m-t-10">
                                            <div class="col-xs-12">
                                                <button class="btn btn-md btn-block btn-primary waves-effect waves-light" type="submit"   v-on:click.prevent="login" v-bind:disabled="missingPassword" >Cadastrar</button>                                        </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- end card-box-->
                    </div>
                    <!-- end wrapper -->
                </div>
            </div>
        </div>
    </section>
</div>
<!-- END HOME -->
<script type="text/javascript">

    Vue.http.headers.common['x-auth'] = '<?php print $this->session->token ?>';

    var vm = new Vue({
        el: '#app',
        data: {
            form: {
                password: '',
                password2: '',
                user_id: '<?php print $this->uri->segment(3)?>'
            },
            attemptSubmit: false
        },
        mounted() {

           // this.$http.get('http://localhost:3000/projects').then(response => {
            //     if(response.body.status == 200)
            //        this.projects = response.body.projects;
                //console.log();
            //  });
        },
        methods: {
            redirect: function(id){
                window.location = '<?php print site_url('/projects/view/')?>'+id;
            },


            login: function(){
                if(this.verifyPassword) return null;
                this.$http.patch('http://localhost:3000/clients/setAccount', JSON.stringify(this.form)).then(response => {
                    this.$http.post('<?php print site_url('/login/process')?>', {token: response.body.token, account: response.body.user.account }).then(responseLocal => {
                        switch (response.body.status) {
                            case 400:
                                swal('Poxa', 'Ocorreu um problema, entre em contato com o suporte! Código do erro: SPS-400', 'error');
                                break;
                            case 200:
                                swal({
                                    title: 'Tudo certo!',
                                    text: 'Você está sendo redirecionado para seleção de fotos',
                                    timer: 2300,
                                    onOpen: function () {
                                        swal.showLoading()
                                    }
                                }).then(
                                    function () {
                                    },
                                    // handling the promise rejection
                                    function (dismiss) {
                                        if (dismiss === 'timer') {
                                            window.location = '<?php print site_url('/selection/myEvent')?>';
                                        }
                                    }
                                );
                                break;
                            default:
                                swal('Poxa', 'Ocorreu um problema, entre em contato com o suporte! Código do erro: SPS-900', 'error');
                                break;
                        }
                    });
                });
            }
        },
        computed: {
            missingPassword: function () { return this.form.password === ''; },
            verifyPassword: function () {
               if(this.form.password !=  this.form.password2){
                        swal('Ops', 'As senhas não conferem', 'error')
                        this.form.password = '';
                        this.form.password2 = '';
                        return true;
                    }
                return false;
            }
        }
    });

</script>

<!-- jQuery -->

<script src="<?php print site_url('assets/js/jquery.min.js')?>"></script>
<script src="<?php print site_url('assets/js/bootstrap.min.js')?>"></script>
<script src="<?php print site_url('assets/js/waves.js')?>"></script>
<script src="<?php print site_url('assets/js/jquery.slimscroll.js')?>"></script>
<script src="<?php print site_url('assets/js/jquery.scrollTo.min.js')?>"></script>

<script src="<?php print site_url('plugins/sweet-alert2/sweetalert2.min.js')?>"></script>
<script src="<?php print site_url('assets/pages/jquery.sweet-alert.init.js')?>"></script>

</body>
</html>