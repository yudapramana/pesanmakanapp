<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login dengan Foto Kamera</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="icon" href="<?= base_url('assets/images/logo-bg.ico') ?>" type="image/x-icon">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            background: linear-gradient(to right, #6a11cb, #2575fc);
            color: white;
        }
        .bg {
            background-image: url('https://source.unsplash.com/1600x900/?nature,water');
            height: 100%;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            position: absolute;
            width: 100%;
            z-index: -1;
            filter: blur(8px);
            -webkit-filter: blur(8px);
        }
        .login-container {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-box {
            background: rgba(0, 0, 0, 0.7);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
        }
        .login-box h2 {
            margin-bottom: 30px;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        #camera {
            display: block;
            margin: 20px auto;
        }
        #captureButton {
            display: block;
            margin: 20px auto;
        }
    </style>
</head>
<body>
    <div class="bg"></div>
    <div class="container login-container">
        <div class="login-box">
            <h2 class="text-center">Login dengan Foto Kamera</h2>
            <form action="<?= base_url('loginFoto/upload_photo'); ?>" method="post" enctype="multipart/form-data" id="photoForm">
                <div class="form-group">
                    <label for="cameraInput">Ambil Foto:</label>
                    <video id="camera" width="320" height="240" autoplay></video>
                    <button type="button" class="btn btn-secondary" id="captureButton">Ambil Foto</button>
                    <input type="hidden" id="cameraInput" name="cameraInput">
                </div>
                <a href="<?= base_url('Antrian') ?>" class="btn btn-primary btn-block">
                    <i class="fa fa-arrow-right"></i> LIHAT ANTRIAN PESANAN
                </a>
            </form>
        </div>
    </div>

    <script>
        const video = document.getElementById('camera');
        const captureButton = document.getElementById('captureButton');
        const cameraInput = document.getElementById('cameraInput');
        const photoForm = document.getElementById('photoForm');

        navigator.mediaDevices.getUserMedia({ video: true })
            .then(stream => {
                video.srcObject = stream;
            })
            .catch(err => {
                console.error('Error accessing the camera: ' + err);
            });

        captureButton.addEventListener('click', () => {
            const canvas = document.createElement('canvas');
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
            const dataURL = canvas.toDataURL('image/png');
            cameraInput.value = dataURL;
            photoForm.submit();
        });
    </script>
</body>
</html>
