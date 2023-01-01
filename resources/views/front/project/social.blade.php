<style type="text/css">
    .mt-100 {
        margin-top: 100px
    }
    .modal-content{
        width: 100%;
        margin-bottom: 1000px;
        box-sizing: border-box;
        margin: auto;
        max-width: 480px;
    }

    .modal-title {
        font-weight: 900
    }

    .modal-content {
        border-radius: 13px
    }

    .modal-body {
        color: #3b3b3b
    }

    .img-thumbnail {
        border-radius: 33px;
        width: 61px;
        height: 61px
    }

    .modal-content .fab:before,.modal-content .fas:before {
        position: relative;
        top: 13px
    }

    .smd {
        width: 200px;
        font-size: small;
        text-align: center
    }

    .smd a{
        color: #333;
    }

    .modal-footer {
        display: block
    }

    .ur {
        border: none;
        background-color: #e6e2e2;
        border-bottom-left-radius: 4px;
        border-top-left-radius: 4px
    }

    .cpy {
        border: none;
        background-color: #e6e2e2;
        border-bottom-right-radius: 4px;
        border-top-right-radius: 4px;
        cursor: pointer
    }

    button.focus,
    button:focus {
        outline: 0;
        box-shadow: none !important
    }

    .ur.focus,
    .ur:focus {
        outline: 0;
        box-shadow: none !important
    }

    .message {
        font-size: 11px;
        color: #ee5535
    }
</style>


<div class="modal fade" id="modal_social" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content col-12">
            <div class="modal-header">
                <h5 class="modal-title">Bagikan</h5> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
            </div>
            <div class="modal-body">
                <div class="icon-container1 d-flex">
                    <div class="smd">
                        <a href="whatsapp://send?text=Bantu%20donasi%20yuk%2C%20klik%20link%20berikut%20untuk%20menuju%20campaign%20{{ url()->current() }}" target="_blank">
                            <i class="img-thumbnail fab fa-whatsapp fa-2x" style="color: #25D366;background-color: #cef5dc;"></i>
                            <p>Whatsapp</p>
                        </a>
                    </div>
                    <div class="smd">
                        <a href="https://twitter.com/share?url={{ url()->current() }}&amp;text=Bantu%20Donasi%20Yuk&amp;hashtags=#berbagikebaikan" target="_blank">
                            <i class=" img-thumbnail fab fa-twitter fa-2x" style="color:#4c6ef5;background-color: aliceblue"></i>
                            <p>Twitter</p>
                        </a>
                    </div>
                    <div class="smd">
                        <a href="http://www.facebook.com/sharer.php?u={{ url()->current() }}" target="_blank">
                            <i class="img-thumbnail fab fa-facebook fa-2x" style="color: #3b5998;background-color: #eceff5;"></i>
                            <p>Facebook</p>
                        </a>
                    </div>
                    <div class="smd">
                        <a target="_blank" href="https://mail.google.com/mail/?view=cm&fs=1&tf=1&to=&su=Bantu%20Donasi%20Yuk&body=Bantu%20donasi%20yuk%2C%20klik%20link%20berikut%20untuk%20menuju%20campaign%20{{ url()->current() }}">
                            <i class="img-thumbnail fas fa-envelope fa-2x" style="color: red;background-color: #eceff5;"></i>
                            <p>Email</p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="modal-footer"> <label style="font-weight: 600">Bagikan Link <span class="message"></span></label><br />
                <div class="row">
                    <input class="col-10 ur" type="url" value="{{ url()->current() }}" id="share-url" style="height: 40px;">
                    <button class="cpy" id="btn-copy"><i class="far fa-clone"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $("#btn-copy").on("click", function(){
            var text = $("#share-url").val();
            $("#share-url").select();
            document.execCommand("copy");

            var toast = new iqwerty.toast.Toast();
            toast.setText('Text disalin ke papan klip').show();
        });
    });
</script>