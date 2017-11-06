
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
                                <h5 class="text-uppercase font-bold m-b-5 m-t-50">Sign In</h5>
                                <p class="m-b-0">Login to your Admin account</p>
                            </div>

                            <div class="account-content">
                                <form class="form-horizontal" action="#">
                                    <div class="form-group m-b-20">
                                        <div class="col-xs-12">
                                            <label for="emailaddress">Email address</label>
                                            <input class="form-control" name="email" type="email" id="emailaddress" required="" placeholder="meu@email.com" v-model="email">                                        </div>
                                    </div>
                                    <div class="form-group m-b-20">
                                        <div class="col-xs-12">
                                            <a href="page-recoverpw.html" class="text-muted pull-right"><small>Forgot your password?</small></a>
                                            <label for="password">Password</label>
                                            <input class="form-control" name="password" type="password" required="" id="password" placeholder="Digite sua senha" v-model="password">
                                        </div>
                                    </div>

                                    <div class="form-group m-b-20">
                                        <div class="col-xs-12">

                                            <div class="checkbox checkbox-success">
                                                <input id="remember" type="checkbox" checked="">
                                                <label for="remember">
                                                    Remember me
                                                </label>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="form-group text-center m-t-10">
                                        <div class="col-xs-12">
                                            <button class="btn btn-md btn-block btn-primary waves-effect waves-light" type="submit"   v-on:click.prevent="login" v-bind:disabled="!isValid" >Entrar</button>                                        </div>
                                    </div>

                                </form>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="text-center">
                                            <button type="button" class="btn m-r-5 btn-facebook waves-effect waves-light">
                                                <i class="fa fa-facebook"></i>
                                            </button>
                                            <button type="button" class="btn m-r-5 btn-googleplus waves-effect waves-light">
                                                <i class="fa fa-google"></i>
                                            </button>
                                            <button type="button" class="btn m-r-5 btn-twitter waves-effect waves-light">
                                                <i class="fa fa-twitter"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="row m-t-50">
                                    <div class="col-sm-12 text-center">
                                        <p class="text-muted">Don't have an account? <a href="page-register.html" class="text-dark m-l-5"><b>Sign Up</b></a></p>
                                    </div>
                                </div>

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
    function validateEmail(email) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }
    var vm = new Vue({
        el: '#app',
        data: {
            email: '',
            password: '',
            message: ''
        },
        methods: {
            show: function() {
                this.showParagraph = true;
                this.updateTitle('The vueJS instance(UPDATED)');
                this.$refs.myButton.innerText = 'Test!';
            },
            updateTitle: function(title){
                this.title = title;
            },
            login: function(){

                this.$http.post('http://localhost:3000/users/login', {email: this.email, password: this.password}).then(response => {
                    var user = response.body;
                    if(user.status != 200)
                        return swal('Ei', 'Seu E-mail ou senha está incorreto.', 'warning')
                        //console.log('Yeah1');
                        //console.log(user.token);
                        //user.token
                        console.log(user);
                        this.$http.post('<?php print site_url('/login/process')?>', {token: user.token, account: user.result.account }).then(response => {
                            console.log(response);
                            if(response.body.status != 200)
                                return swal('Poxa', 'Ocorreu um problema com o seu acesso, entre em contato com o suporte! Código do erro: LO-500', 'error')
                            //console.log('Yeah2');

                            window.location = '<?php print site_url('/dashboard')?>';

                        }).catch(function(err) {
                            console.log(err); // It goes here!
                        });

            }).catch(function(err) {
                    swal('Poxa', 'Ocorreu um problema com o seu acesso, entre em contato com o suporte! Código do erro: LO-400', 'error');
                });

            }
        },
        computed: {
            isValid: function () {
                return this.email != '' && this.password != '' && this.password.length >= 6 && validateEmail(this.email)
            }
        },
        watch: {
            title: function(value){
                alert('Title was changed, new value: '+value);
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