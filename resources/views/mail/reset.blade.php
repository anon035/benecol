<div style="font-family: Roboto; text-align: center; font-size: 16px; max-width: 800px;">
    <img src="{{ asset('images/mail_header.png') }}" />
    <h1>Vaše heslo bolo resetované</h1>
    <p>
        Tento email Vám bol doručený na základe Vašej požiadavky o reset hesla.
        Nižšie zasielame nové heslo.
        Prosíme Vás aby ste si ho po prihlásení zmenili.
        Na <a href="https://benecol.sk/login">tomto</a> odkaze sa môžte prihlásiť pomocou nižšie uvedených
        údajov.
        <br/>
        Ďakujeme a prajeme Vám veľa úspechov.
    </p>
    <h2>
        Vaše prihlasovacie údaje:
    </h2>
    <p>
        Prihlasovacie (registračné čislo): <span
            style="font-size: 1.3rem; font-weight: bold;">{{ $registration_number }}</span><br />
        Prihlasovacie heslo: <span style="font-size: 1.3rem; font-weight: bold;">{{ $password }}</span>
    </p>
</div>
