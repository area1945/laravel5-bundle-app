<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Kontak Person</title>
        <!-- Styles -->
       <style>
        table {
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 5px;
        }
       </style>
    </head>
    <body>
        <table class="table table-striped table-bordered">
            <thead>
               <tr>
                    <th width="40">No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Website</th>
                    <th>Alamat</th>
               </tr>
            </thead>
            <tbody>
                @foreach($contacts as $index => $contact)
                    <tr>
                        <td width="40">{{ ++$index }}</td>
                        <td>{{ $contact->name }}</td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ $contact->phone }}</td>
                        <td>{{ $contact->website }}</td>
                        <td>{{ $contact->address }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>

