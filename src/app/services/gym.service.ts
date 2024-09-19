import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class GymService {
  private baseUrl = 'http://localhost/gym-management/backend/'; // Cambia la ruta según tu configuración

  constructor(private http: HttpClient) {}

  // Métodos para Sesiones
  getSesiones(): Observable<any[]> {
    return this.http.get<any[]>(`${this.baseUrl}sesiones/read/read.php`);
  }

  addSesion(sesion: any): Observable<any> {
    return this.http.post(`${this.baseUrl}sesiones/create/create.php`, sesion);
  }

  updateSesion(sesion: any): Observable<any> {
    return this.http.put(`${this.baseUrl}sesiones/update/update.php`, sesion);
  }

  deleteSesion(sesionId: number): Observable<any> {
    return this.http.delete(`${this.baseUrl}sesiones/delete/delete.php`, { body: { sesion_id: sesionId } });
  }
}
