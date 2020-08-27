<table style="font-family: Roboto; text-align: center; font-size: 16px; max-width: 600px;">
    <tr>
        <td>
            <img src="{{ asset('images/mail_header.png') }}" />
        </td>
    </tr>
    <tr>
        <td>
            <h1>Máte novú pozvánku na udalosť <br /> {{ $eventName }}</h1>
        </td>
    </tr>
    <tr>
        <td>
            <p>
                Boli ste prihlásený na udalosť {{ $eventName }}.
                Prosíme Vás aby ste sa čo najskôr vyjadrili o Vašej prítomnosti/neprítomnosti na tejto udalosti.<br />
                Na <a href="{{ $eventLink }}">tomto</a> odkaze sa môžte vyjadriť.
                <br />
                <br />
                Ďakujeme a prajeme Vám veľa úspechov.
            </p>
        </td>
    </tr>
    <tr>
        <td>
            <p>
                Ak si neželáte dostávať tieto oznámenia, môžete to zmenit v sekcií Môj Profil,<br />
                alebo kliknite na <a href="https://benecol.sk/profile">tento</a> odkaz.
            </p>
        </td>
    </tr>
</table>