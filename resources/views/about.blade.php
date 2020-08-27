@extends('layouts.base', ['title' => 'O nás'])

@section('content')

<!-- Club Section Start -->
<div class="rs-club sec-spacer">
    <div class="container">
        <h3 class="title-bg">O našej akadémií</h3>
        <div class="row">
            <div class="col-md-12">
                <div class="rs-club-text">
                    <div class="rs-club-image">
                        <img src="{{asset('images/about-us/about-us-right.png')}}" alt="">
                    </div>
                    <p class="justify-about-us">
                        Veľkú a nezastupiteľnú zásluhu na rozvoji mal, žiaľ, dnes už zosnulý prezident
                        Východoslovenského futbalového zväzu /VsFZ/ a viceprezident SFZ JUDr. Bohdan Benedik. Stál aj
                        pri vzniku akadémie a prepožičal jej aj svoje meno /BENE – Benedik a COL – kolektív/.
                    </p>
                    <p class="justify-about-us">
                        Prezidentom a šéftrénerom akadémie je René Babušík. Celý svoj život zasvätil futbalu ako bývalý
                        hráč Banskej Bystrice, VSS Košíc, Slovana Bratislava a ako tréner pôsobil vo viacerých
                        futbalových kluboch, kde mal možnosť svoju činnosť rozvíjať po boku trénera reprezentácie Jozefa
                        Vengloša a hlavného trénera Dukly Banskej Bystrice Petra Benedika. Rovnako tak mal možnosť
                        podieľať sa na výchove hráčov ktorí hrávajú za Slovenskú reprezentáciu ako Pečovský, Mucha,
                        Čišovský alebo Ďuriš.
                    </p>
                    <p class="justify-about-us">
                        V roku 2016 sme začali spolupracovať ako partnerský klub s CFT Academy. Spolupráca priniesla
                        pravidelné školenia trénerov a učeniu nových trendov, pretože aj tréning môže byť zábavný. Okrem
                        školení trénerov táto spolupráca ponúka aj nový koncept rozvoja hráčov, ktorý je obsiahnutý v
                        každom tréningovom procese. V lete roku 2017 došlo k podpisu zmluvy o spolupráci pri realizácii
                        programu Skill Full Age kde sa CFT Academy stala prvým partnerským klubom organizácie Coerver®
                        Coaching na Slovensku. Vďaka týmto krokom CFT sa aj nášmu klubu otvorili nové možnosti rozvoja
                        získaním kompletnej metodiky Coerver® ako partnerského klubu CFT Academy. Zaradili sme sa tak
                        medzi kluby ako Benfica Lisabon, Glasgow Rangers, Viktoria Plzeň… ktoré túto metodiku školení a
                        rozvoja využívaju.
                    </p>
                    <p class="justify-about-us">
                        S našimi odchovancami sa môžete stretnúť v rôznych kategóriách od regionálnych klubov cez Slovan
                        Bratislava až po portugalský klub S.C.Freamunde. Rovnako tak sme mali možnosť stretnúť sa s
                        klubmi zvučného mena ako Wisla Krakow, Lechia Gdansk, Leverkusen, Djurgarden Stockholm, Austria
                        a Rapid Viedeň, 1.FC Leonhofen, FC Everton, FC Liverpool…
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Club Section End -->

<!--RS History Section Start Here-->
<div class="rs-history-area">
    <div class="container">
        <div class="row about-us">
            <div class="col-md-4 profile-picture">
                <div class="rs-mission-image">
                    <img src="{{asset('images/about-us/profile.png')}}" alt="">
                </div>
                <div class="president-info">
                    <h4>
                        Mgr.Dominik Babušík<br />
                        <small>Manažér klubu</small>
                    </h4>
                </div>
            </div>
            <div class="about-text col-md-8">
                "Od svojho vzniku stihla naša akadémia zrealizovať výstavbu miniihriska s umelým povrchom
                v roku 2007 a výstavbu veľkého trávnatého futbalového ihriska riadnych hracích rozmerov
                v roku 2011 a dobudovanou automatickou závlahou v roku 2017 ako prvý klub v Košiciach.
                Už po troch rokoch pôsobenia sme hrali barážový zápas o postup do I.ligy."<br />
                <br />
                "Akadémia bola založená v roku 2004 ako občianske združenie na podporu mládeže. Jej
                cieľom je pripravovať chlapcov a dievčatá pre zvyšovanie kvality futbalovej hry, ale v
                prvom rade kladie dôraz na formovanie osobnosti mladého športovca."<br />
                <br />
                "Zdôrazniť rozvoj sebaúcty, dobrého športovania, zdatnosti, úspechu, tímovej práce a
                zručností, ako aj povzbudiť zdvorilosť, správne správanie a rešpektovanie autority zo
                strany hráčov, funkcionárov a divákov prostredníctvom hry."
            </div>
        </div>
    </div>
</div>

@endsection