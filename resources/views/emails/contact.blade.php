<!DOCTYPE html>
<html>
<head>
    <title>Pesan dari Pelanggan</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <h2 style="color: #39AE1F;">Ada Pesan Baru nih Bos Bar Bar! 🍨</h2>
    <p>Berikut adalah detail pesan dari pelanggan:</p>
    
    <table style="width: 100%; border-collapse: collapse;">
        <tr>
            <td style="padding: 8px; border: 1px solid #ddd; width: 100px;"><strong>Nama</strong></td>
            <td style="padding: 8px; border: 1px solid #ddd;">{{ $data['name'] }}</td>
        </tr>
        <tr>
            <td style="padding: 8px; border: 1px solid #ddd;"><strong>No WhatsApp</strong></td>
            <td style="padding: 8px; border: 1px solid #ddd;">+62{{ $data['phone'] }}</td>
        </tr>
        <tr>
            <td style="padding: 8px; border: 1px solid #ddd;"><strong>Email</strong></td>
            <td style="padding: 8px; border: 1px solid #ddd;">{{ $data['email'] }}</td>
        </tr>
        <tr>
            <td style="padding: 8px; border: 1px solid #ddd;"><strong>Isi Pesan</strong></td>
            <td style="padding: 8px; border: 1px solid #ddd;">{{ $data['message'] }}</td>
        </tr>
    </table>
</body>
</html>