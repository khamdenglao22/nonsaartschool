<div class="login login-v1">
    <div class="login-container">

        <div class="login-header">
            <div class="brand">
                <div class="d-flex align-items-center">
                    ລະບົບການລົງທະບຽນຂອງ ໂຮງຮຽນປະຖົມໂນນສະອາດ
                </div>
            </div>
            <div class="icon">
                <i class="fa fa-lock"></i>
            </div>
        </div>


        <div class="login-body">
            <div class="login-content fs-13px">
                <form id="loginForm" action="" method="post">
                    <div class="form-floating mb-20px">
                        <input type="text" class="form-control fs-13px h-45px" id="username" placeholder="User Name">
                        <label for="userName" class="d-flex align-items-center py-0">Username</label>
                    </div>
                    <div class="form-floating mb-20px">
                        <input type="password" class="form-control fs-13px h-45px" id="password" placeholder="Password">
                        <label for="password" class="d-flex align-items-center py-0">ລະຫັດຜ່ານ</label>
                    </div>

                    <div class="login-buttons">
                        <button type="submit" id="btn-login" class="btn h-45px btn-success btn-block w-100 btn-lg">ເຂົ້າສູ້ລະບົບ</button>
                        <button hidden id="btn-login-loading" class="btn h-45px btn-success btn-block w-100 btn-lg" type="button" disabled>
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Loading...
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>