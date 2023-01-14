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
                            <h2 class="content-header-title float-start mb-0">Termeni si Conditii</h2>
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
                        <div class="card-body">
                            <br />
                            <p class="card-text">Va multumim pentru utilizarea Stafeta Muntilor Software. Software-ul este oferit gratuit de catre Asociatia Drumetii Montane prin proiectul MarketingRomania.ro.</p>
                            <p class="card-text">Stafeta Muntilor Software a fost realizat cu ajutorul voluntarilor: Sergiu Valentin Vlad si Alexandru Canavoiu in anul 2015 si continuat de catre Alexandru Canavoiu.</p>
                            <p class="card-text"><strong>Art 1.</strong> Stafeta Muntilor Software a fost realizat cu scopul de a sprijinii ONG-urile ce organizeaza etape in cadrul Campionatului National de Turism Sportiv Stafeta Muntilor. Software-ul se bazeaza pe Regulamentul Competitionalce al competitiei Stafeta Muntilor (www.stafetamuntilor.ro).</p>
                            <p class="card-text"><strong>Art 2.</strong> Acest program este distribuit cu speranța că va fi util, dar FĂRĂ NICI O GARANȚIE; fără macar garanția implicită de vandabilitate sau CONFORMITATE UNUI ANUMIT SCOP. </p>
                            <p class="card-text"><strong>Art 3.</strong> Puteti copia si distribui copii nemodificate ale codului sursa al Software-ul in forma in care il primiti, prin orice mediu, cu conditia sa specificati vizibil pe fiecare copie autorul si lipsa oricarei garantii, sa pastrati intacte toate notele referitoare la aceasta licenta si la absenta oricarei garantii si sa distribuiti o copie a acestei Licente cu fiecare copie a Software-ul. </p>
                            <p class="card-text"><strong>Art 4.</strong> Orice proiect pe care il distribuiti sau publicati, care in intregime sau in parte contine sau este derivat din acest Software (sau orice parte a acestuia), trebuie sa poata fi folosit de oricine, gratuit si in intregime, in termenii acestei Licente. </p>
                            <p class="card-text"><strong>Art 5.</strong> NU EXISTA NICI O GARANTIE PENTRU SOFTWARE, IN MASURA PERMISA DE LEGILE CE SE APLICA. EXCEPTTND SITUATIILE UNDE ESTE SPECIFICAT ALTFEL IN SCRIS, DETINATORII DREPTURILOR DE AUTOR SI/SAU ALTE PARTI IMPLICATE OFERA SOFTWARE-UL \"IN FORMA EXISTENTA\" FARA NICI O GARANTIE DE NICI UN FEL, EXPLICITA SAU IMPLICITA, INCLUZTND, DAR FARA A FI LIMITATA LA, GARANTII IMPLICITE DE VANDABILITATE SI CONFORMITATE UNUI ANUMIT SCOP. VA ASUMATI IN INTREGIME RISCUL IN CEEA CE PRIVESTE CALITATEA SI PERFORMANTA ACESTUI SOFTWARE. IN CAZUL IN CARE PROGRAMUL SE DOVEDESTE A FI DEFECT, VA ASUMATI IN INTREGIME COSTUL TUTUROR SERVICIILOR, REPARATIILOR SI CORECTIILOR NECESARE. </p>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection