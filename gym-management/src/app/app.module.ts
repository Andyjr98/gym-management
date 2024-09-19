import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { HttpClientModule } from '@angular/common/http';
import { FormsModule } from '@angular/forms';
import { RouterModule, Routes } from '@angular/router';

import { AppComponent } from './app.component';
import { MiembrosComponent } from './components/miembros/miembros.component';
import { EntrenadoresComponent } from './components/entrenadores/entrenadores.component';
import { SesionesComponent } from './components/sesiones/sesiones.component';

// Definición de rutas
const routes: Routes = [
  { path: 'miembros', component: MiembrosComponent },
  { path: 'entrenadores', component: EntrenadoresComponent },
  { path: 'sesiones', component: SesionesComponent },
  { path: '', redirectTo: '/miembros', pathMatch: 'full' },
];

@NgModule({
  declarations: [
    AppComponent,
    MiembrosComponent,
    EntrenadoresComponent,
    SesionesComponent,
  ],
  imports: [
    BrowserModule,
    HttpClientModule,
     FormsModule, // Importando FormsModule
    RouterModule.forRoot(routes), // Configuración de rutas
  ],
  providers: [],
  bootstrap: [AppComponent],
})
export class AppModule {}
