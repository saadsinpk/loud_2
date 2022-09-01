@extends('layouts.email')
@section('content')
<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td align="justify"
            style="padding: 20px 0px 0px 0px; color: #153643;  font-size: 16px; line-height: 20px;">
            Hello,<br/>
            <p><strong>{{$otp}}</strong> is the OTP to reset your password.</p>
        </td>
    </tr>
</table>
@endsection 