<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
</head>
<body>
    <form action="{{route('import_excel')}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" name="document" id="documentInput">
        <input type="submit" value="Send">
    </form>

    <!-- <script>
        const input = document.getElementById('documentInput');

        const upload = (file) => {
            let xcsrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            console.log(xcsrf)
            fetch('http://excelproject.loc/import/excel', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': xcsrf,
                },
                body: file
            }).then(
                response => response.json()
            ).then(
                success => {
                    console.log(success)
                    let data = JSON.parse(success)
                    if (data['success'] === 1) {
                        chunk(data)
                    }
                }
            ).catch(
                error => console.log(error)
            );
        };

        const chunk = (data) => {
            let xcsrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            console.log(xcsrf)
            fetch('http://excelproject.loc/chunk', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': xcsrf,
                },
                body: data
            }).then(
                response => response.json()
            ).then(
                success => {
                    console.log(success)
                    let data = JSON.parse(success)
                    if (data['load'] === 1) {
                        console.log('File load')
                    } else {
                        chunk(JSON.stringify(data))
                    }
                }
            ).catch(
                error => console.log(error)
            );
        }

        const onSelectFile = () => upload(input.files[0]);

        input.addEventListener('change', onSelectFile, false);
    </script> -->

</body>
</html>