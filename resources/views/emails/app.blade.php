<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body class="body"
      style="box-sizing: border-box; background-color: rgb(248, 250, 252); color: rgb(116, 120, 126); height: auto; margin: 0; word-break: break-word; width: 100% !important;">
<div style="overflow: auto; width: 100%;">
    <table class="content" style="margin: 0; padding: 0; width: 100%;">
        <tbody>
        @include('emails._header')

        <tr>
            <td class="body"
                style="background-color: #ffffff; border-bottom: 1px solid #edeff2; border-top: 1px solid #edeff2; margin: 0; padding: 0; width: 100%;">
                <table class="inner-body" style="margin: 0 auto; padding: 0;">
                    <tbody>
                    <tr>
                        <td class="content-cell" style="padding: 35px;">
                            @yield('content')
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>

        @include('emails._footer')
        </tbody>
    </table>
</div>
</body>
