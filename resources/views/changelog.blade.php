@extends('layouts/app')
@section('title') Stafeta Muntilor - Changelog @endsection
@section('content')
<div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Changelog</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
            <section>
            <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">[ v6.2.1 ] - 25.06.2025</h4>
                    </div>
                    <div class="card-body">
                        <br />
                        <p class="card-text">[Bug Fix]</p>
                        <p class="card-text">- Setare timp 00:00:00 de start la Orientare daca proba este inainte de Raid.</p>
                        <p class="card-text">- Daca proba de Alpinism nu se organizeaza, sa nu apara in clasamente si sa fie obligatorie in clasamentul general.</p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">[ v6.2.0 ] - 14.06.2025</h4>
                    </div>
                    <div class="card-body">
                        <br />
                        <p class="card-text">[Adaugare]</p>
                        <p class="card-text">- Clasament Alpinism conform regulament Articolul 12 - PROBA DE ALPINISM</p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">[ v6.1.0 ] - 09.06.2025</h4>
                    </div>
                    <div class="card-body">
                        <br />
                        <p class="card-text">[Bug Fix]</p>
                        <p class="card-text">- Alerta daca echipa nu are CHIP la import sa ii dea ignore si afisare cu eroare</p>
                        <p class="card-text">- Afisare eroare la clasament etapa daca exista echipe care nu au inca completata proba Cunostinte Turistice</p>
                        <p class="card-text">[Adaugare]</p>
                        <p class="card-text">- Camp "Esclada" la Club pentru organizatorul etapei daca a organizat escalada pentru acordare 200puncte conform regulament</p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">[ v6.0.0 ] - 01.06.2025</h4>
                    </div>
                    <div class="card-body">
                        <br />
                        <p class="card-text">[Bug Fix]</p>
                        <p class="card-text">- Cumulat Etape pentru categorii - clasament.</p>
                        <p class="card-text">- Export baza de date</p>
                        <p class="card-text">- Fara puncte negative la orientare</p>
                        <p class="card-text">[Adaugare]</p>
                        <p class="card-text">- Modificare Software dupa regulament Stafeta Muntilor 2025</p>
                        <p class="card-text">- Import din CSV timp folosind sistemul SPORTIDENT pentru Orientare/Raid + CHIPNO pentru echipe si validare nume echipe</p>
                        <p class="card-text">- Modificare campuri configurare statii de RAID/Orientare</p>
                        <p class="card-text">[Stergere]</p>
                        <p class="card-text">- Import folosind sistemul Ultra Orienteering + configurare statii orientare/raid pentru acest sistem</p>
                        <p class="card-text">- La editarea/adaugarea unei echipe a fost sterse campurile UUIDs</p>
                        <p class="card-text">- La editarea/adaugarea unei echipe campul "Numar de participare" nu mai este obligatoriu de completat</p>
                        <p class="card-text">- Din dashboard PDF-urile cu regulament/fise au fost eliminate</p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">[ v5.0.2 ] - 20.07.2024</h4>
                    </div>
                    <div class="card-body">
                        <br />
                        <p class="card-text">[Bug Fix]</p>
                        <p class="card-text">- Redirect Clasament Orientare/Raid.</p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">[ v5.0.1 ] - 09.07.2024</h4>
                    </div>
                    <div class="card-body">
                        <br />
                        <p class="card-text">[Bug Fix]</p>
                        <p class="card-text">- Atunci cand o echipa este descalificata la Raid Montan sa nu mai apara in clasament Lipsa Bocanci.</p>
                        <p class="card-text">[Adaugare]</p>
                        <p class="card-text">- CI + Telefon Participant pentru identificare in loc de CNP</p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">[ v5.0.0 ] - 16.03.2024</h4>
                    </div>
                    <div class="card-body">
                        <br />
                        <p class="card-text">[Bug Fix]</p>
                        <p class="card-text">- Generare clasamente doar daca toate echipele au datele completate corect.</p>
                        <p class="card-text">[Adaugare]</p>
                        <p class="card-text">- Actualizare Software in baza regulamentului din 2024</p>
                        <p class="card-text">- Afisarea siglei Federatiei Romane de Turism Sportiv la exportul clasamentelor in PDF pentru afisare.</p>
                        <p class="card-text">- Sectiune pentru a putea asocia persoane la o echipa.</p>
                        <p class="card-text">- Pastrare Cluburi de la o etapa la alta</p>
                        <p class="card-text">- Generare Clasament Cluburi Etape.</p>
                        <p class="card-text">- Generare Clasament Individual dupa fiecare etapa si cumularea punctelor pe parcursul etapelor.</p>
                        <p class="card-text">- Buton de export baza de date in sectiunea Configurare</p>
                    </div>
                </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">[ v4.1.4 ] - 19.06.2023</h4>
                        </div>
                        <div class="card-body">
                            <br />
                            <p class="card-text">[Bug Fix]</p>
                            <p class="card-text">- Import date Raid Montan, stergere date existente si inlocuire cu cele noi, in cazul in care se reimporta fisierul.</p>
                            <p class="card-text">[Adaugare]</p>
                            <p class="card-text">- Lista ceasuri Raid Montan/Orientare in Echipe in caz ca numerele ceasurilor sunt sterse si trebuie sa identificam numarul ceasului dupa UUID.</p>
                            <p class="card-text">- Modificare timezone din GMT+3 in GMT.</p>
                        </div>
                    </div>
                </section>
                <section>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">[ v4.1.3 ] - 07.06.2023</h4>
                        </div>
                        <div class="card-body">
                            <br />
                            <p class="card-text">[Bug Fix]</p>
                            <p class="card-text">- Ordine Import PA-uri Raid Montan</p>
                        </div>
                    </div>
                </section>
                <section>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">[ v4.1.2 ] - 02.04.2023</h4>
                        </div>
                        <div class="card-body">
                            <br />
                            <p class="card-text">[Bug Fix]</p>
                            <p class="card-text">- all fonts to be local</p>
                        </div>
                    </div>
                </section>
                <section>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">[ v4.1.1 ] - 02.04.2023</h4>
                        </div>
                        <div class="card-body">
                            <br />
                            <p class="card-text">[Bug Fix]</p>
                            <p class="card-text">- generare de unixtime pentru statii</p>
                            <p class="card-text">- validari formulare si generare clasamente</p>
                        </div>
                    </div>
                </section>
                <section>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">[ v4.1.0 ] - 16.01.2023</h4>
                        </div>
                        <div class="card-body">
                            <br />
                            <p class="card-text">[Adaugare]</p>
                            <p class="card-text">- actualizare aplicati cu noul regulament 2023: Fiecare club primeste 10 puncte daca participa la cel putin o proba.</p>
                        </div>
                    </div>
                </section>
                <section>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">[ v4.0.0 ] - 25.12.2022</h4>
                        </div>
                        <div class="card-body">
                            <br />
                            <p class="card-text">- migrare la laravel framework</p>
                            <p class="card-text">[Adaugare]</p>
                            <p class="card-text">- posibilitatea de a introduce numarul de participare a echipei</p>
                            <p class="card-text">- posibilitatea de a selecta ceasuri diferite la Orientare/Raid Montan</p>
                            <p class="card-text">- clasament provizoriu per categorie chiar daca nu sunt completate toate datele</p>
                            <p class="card-text">- validare timpi introdusi in Raid Montan</p>
                            <p class="card-text">[Stergere]</p>
                            <p class="card-text">- posibilitatea de a adauga mai multe echipe in acelasi timp</p>
                            <p class="card-text">[Bug Fix]</p>
                            <p class="card-text">- bonus echipe</p>
                            <p class="card-text">- configurare random PA Raid Montan</p>
                            <p class="card-text">- eliminare penalizare PA Raid Montan daca sunt mai mult de 5 secunde peste minut. Adica, daca penalizarea este 00:01:20 (ore:minute:secunde), nu se mai penalizeaza 2 minute, ci doar 1 minut.</p>
                            <p class="card-text">- demo date, posibilitatea sa stergeti si sa importati date demonstrative</p>
                            <p class="card-text">- numele echipei in fiecare categorie trebuie sa fie unic</p>
                        </div>
                    </div>
                </section>
                <section>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">[ v3.2.1 ] - 10.07.2019</h4>
                        </div>
                        <div class="card-body">
                            <p class="card-text">[Bug Fix]</p>
                            <p class="card-text">Raid Montan Ultra Orienteering Team import UUIDs</p>
                        </div>
                    </div>
                </section>   
                <section>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">[ v3.2.0 ] - 10.06.2019</h4>
                        </div>
                        <div class="card-body">
                            <p class="card-text">[Adaugare]</p>
                            <p class="card-text">Ultra Orienteering https://www.ultra-orienteering.drumetiimontane.ro/ro pentru Orientare / Raid Montan</p>
                        </div>
                    </div>
                </section>    
                <section>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">[ v3.1 ] - 09.06.2019</h4>
                        </div>
                        <div class="card-body">
                            <p class="card-text">* Actualizare dupa noul regulament competitional 2019</p>
                        </div>
                    </div>
                </section>
                <section>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">[ v3.0 ] - 10.02.2018</h4>
                        </div>
                        <div class="card-body">
                            <p class="card-text">* Actualizare dupa noul regulament competitional 2018</p>
                            <br />
                            <p class="card-text">[Adaugare]</p>
                            <p class="card-text">- Posibilitate de configurare Posturi proba Orientare</p>
                            <p class="card-text">- Afisare posturi gresite echipe pentru proba Orientare</p>
                        </div>
                    </div>
                </section>
                <section>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">[ v2.0 ] - 01.04.2017</h4>
                        </div>
                        <div class="card-body">
                            <p class="card-text">* Actualizare dupa noul regulament competitional 2017</p>
                            <br />
                            <p class="card-text">[Adaugare]</p>
                            <p class="card-text">- Implementare UUID-Card pentru Echipe - se va utiliza pentru proba de orientare unde se va utiliza sistemul http://ultra-orienteering.drumetiimontane.ro/ </p>
                            <p class="card-text">- Importare timp in functie de UUID asociat echipei</p>
                            <p class="card-text">- Adaugare sectiune Cross-Trail unde se poate utiliza sistemul la fel ca la orientare</p>
                        </div>
                    </div>
                </section>
                <section>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">[ v1.2 ] - 03.04.2016</h4>
                        </div>
                        <div class="card-body">
                            <p class="card-text">* Actualizare dupa noul regulament competitional 2016</p>
                            <br />
                            <p class="card-text">[Adaugare]</p>
                            <p class="card-text">- Organizator pentru etapa Amicala</p>
                            <p class="card-text">[Bug Fix]</p>
                            <p class="card-text">- Adaugare cluburi multiple</p>
                            <p class="card-text">- Adaugare echipe multiple la un club</p>
                        </div>
                    </div>
                </section>
                <section>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">[ v1.1 ] - 25.08.2015</h4>
                        </div>
                        <div class="card-body">
                            <br />
                            <p class="card-text">[Adaugare]</p>
                            <p class="card-text">- Adaugare camp Intrebari Gresite la Cunostinte Turistice</p>
                            <p class="card-text">[Bug Fix]</p>
                            <p class="card-text">- afisare clasament</p>
                        </div>
                    </div>
                </section>
                <section>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">[ v1.0 ] - 14.07.2015</h4>
                        </div>
                        <div class="card-body">
                            <br />
                            <p class="card-text">- lansare Initiala</p>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection