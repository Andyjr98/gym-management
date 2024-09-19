import { Component, OnInit } from '@angular/core';
import { GymService } from '../../services/gym.service';

@Component({
  selector: 'app-entrenadores',
  templateUrl: './entrenadores.component.html',
  styleUrls: ['./entrenadores.component.css']
})
export class EntrenadoresComponent implements OnInit {
  entrenadores: any[] = [];
  nuevoEntrenador = { nombre: '', especialidad: '', telefono: '', email: '' };

  constructor(private gymService: GymService) {}

  ngOnInit(): void {
    this.getEntrenadores();
  }

  getEntrenadores() {
    this.gymService.getEntrenadores().subscribe(data => {
      this.entrenadores = data;
    });
  }

  addEntrenador() {
    this.gymService.addEntrenador(this.nuevoEntrenador).subscribe(() => {
      this.getEntrenadores();
      this.nuevoEntrenador = { nombre: '', especialidad: '', telefono: '', email: '' };
    });
  }
}
