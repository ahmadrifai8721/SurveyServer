<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <script type="text/javascript" src="https://unpkg.com/qr-code-styling@1.5.0/lib/qr-code-styling.js"></script>
</head>

<body>
    <div id="canvas"></div>

    <script type="text/javascript">
        document.getElementById('canvas').addEventListener('click', function() {
            qrCode.download({
                name: "{{ $apk->name }}",
                extension: "png"
            });
        });
    </script>
    <script type="text/javascript">
        const qrCode = new QRCodeStyling({
            width: {{ $size }},
            height: {{ $size }},
            type: "png",
            data: "{{ route('APK.show', $apk->id) }}",
            image: "{{ asset('assets/images/bg-auth.JPG') }}",
            dotsOptions: {
                // color: "#4267b2",
                type: "rounded"
            },
            backgroundOptions: {
                color: "#e9ebee",
            },
            imageOptions: {
                crossOrigin: "anonymous",
                imageSize: 0.6,
                margin: 20
            }
        });

        qrCode.append(document.getElementById("canvas"));
    </script>
</body>

</html>
