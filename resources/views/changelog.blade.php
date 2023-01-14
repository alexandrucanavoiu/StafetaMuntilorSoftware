@extends('layouts/app')
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
                <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                    <div class="mb-1 breadcrumb-right">
                        <div class="dropdown">
                            <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle waves-effect waves-float waves-light" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg></button>
                            <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="app-todo.html"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square me-1"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg><span class="align-middle">Todo</span></a><a class="dropdown-item" href="app-chat.html"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-square me-1"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg><span class="align-middle">Chat</span></a><a class="dropdown-item" href="app-email.html"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail me-1"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg><span class="align-middle">Email</span></a><a class="dropdown-item" href="app-calendar.html"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar me-1"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg><span class="align-middle">Calendar</span></a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">[ v4.0 ] - 25.12.2022</h4>
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