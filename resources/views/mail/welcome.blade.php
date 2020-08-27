<table style="font-family: Roboto; text-align: center; font-size: 16px; max-width: 600px;">
    <tr>
        <td>
            <img src="{{ asset('images/mail_header.png') }}" />
        </td>
    </tr>
    <tr>
        <td>
            <h1>Vitajte vo Futbalovej akadémií <br />BENECOL Košice</h1>
        </td>
    </tr>
    <tr>
        <td>
            <p>
                Tento email Vám bol doručený na základe Vašej úspešnej registrácie {{ $name }}.
                Prosíme Vás aby ste si pri prvom prihlásení <strong style="font-size: 1.2rem">zmenili Vaše prihlasovacie
                    heslo</strong>.
                Na <a href="https://benecol.sk/login">tomto</a> odkaze sa môžte prihlásiť pomocou nižšie uvedených
                údajov.
                <br />
                Ďakujeme a prajeme Vám veľa úspechov.
            </p>
        </td>
    </tr>
    <tr>
        <td>
            <h2>
                Vaše prihlasovacie údaje:
            </h2>
            <p>
                Prihlasovacie (registračné čislo): <span
                    style="font-size: 1.3rem; font-weight: bold;">{{ $registration_number }}</span><br />
                Prihlasovacie heslo: <span style="font-size: 1.3rem; font-weight: bold;">{{ $password }}</span>
            </p>
        </td>
    </tr>
</table>