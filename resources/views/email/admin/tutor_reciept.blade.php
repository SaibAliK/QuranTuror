@extends('email.layout')
@section('subject', 'Join Session')
@section('content')
<div>
    <h1 align="center" style="color: #06090f;font-size:24px;font-weight:bold;margin-top: 30px;text-transform:none;font-family: sans-serif;line-height: 1.4;margin-bottom: 30px;">You have recieved ${{ $data['req']->amount ?? '' }} from Quran Tutors</h1>
</div>

<p style="font-family: sans-serif;text-align:center;color:grey;font-size:16px;margin-bottom: 30px;">{{ $data['req']->note ?? '' }}</p>

<table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary" style="border-collapse: separate;mso-table-lspace: 0pt;mso-table-rspace: 0pt;min-width: 100%;width: 100%;box-sizing: border-box;">
    <tbody>
        <tr>
            <td style="font-family: sans-serif;font-size: 14px;vertical-align: top;background-color: #ea5455;border-radius: 5px;text-align: center;" align="center">
                <table role="presentation" border="0" width="100%" cellpadding="0" cellspacing="0" style="border-collapse: separate;mso-table-lspace: 0pt;mso-table-rspace: 0pt;min-width: 100%;width: 100%;">
                    <tbody>
                        
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>
@endsection
