import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { environment } from '../../environments/environment'; // Asegúrate de que esta ruta sea correcta

@Injectable({
  providedIn: 'root'
})
export class GymService {
  private baseUrl = environment.apiUrl; // Asegúrate de que esta variable esté definida en tu archivo de configuración de entorno

  constructor(private http: HttpClient) {}

  // Métodos para Miembros
  getMiembros(): Observable<any[]> {
    return this.http.get<any[]>(`${this.baseUrl}miembros/read/read.php`);
  }

  addMiembro(miembro: any): Observable<any> {
    return this.http.post<any>(`${this.baseUrl}miembros/create/create.php`, miembro);
  }

  updateMiembro(miembro: any): Observable<any> {
    return this.http.put<any>(`${this.baseUrl}miembros/update/update.php`, miembro);
  }

  deleteMiembro(miembroId: number): Observable<any> {
    return this.http.delete<any>(`${this.baseUrl}miembros/delete/delete.php?id=${miembroId}`);
  }

  // Métodos para Entrenadores
  getEntrenadores(): Observable<any[]> {
    return this.http.get<any[]>(`${this.baseUrl}entrenadores/read/read.php`);
  }

  addEntrenador(entrenador: any): Observable<any> {
    return this.http.post<any>(`${this.baseUrl}entrenadores/create/create.php`, entrenador);
  }

  // Métodos para Sesiones
  getSesiones(): Observable<any[]> {
    return this.http.get<any[]>(`${this.baseUrl}sesiones/read/read.php`);
  }

  addSesion(sesion: any): Observable<any> {
    return this.http.post<any>(`${this.baseUrl}sesiones/create/create.php`, sesion);
  }

  updateSesion(sesion: any): Observable<any> {
    return this.http.put<any>(`${this.baseUrl}sesiones/update/update.php`, sesion);
  }

  deleteSesion(sesionId: number): Observable<any> {
    return this.http.delete<any>(`${this.baseUrl}sesiones/delete/delete.php?id=${sesionId}`);
  }
}
