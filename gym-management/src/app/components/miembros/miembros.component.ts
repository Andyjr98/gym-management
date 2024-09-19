import { Component, OnInit } from '@angular/core';
import { GymService } from '../../services/gym.service';

@Component({
  selector: 'app-miembros',
  templateUrl: './miembros.component.html',
  styleUrls: ['./miembros.component.css']
})
export class MiembrosComponent implements OnInit {
  miembros: any[] = [];
  nuevoMiembro = { miembro_id: null, nombre: '', apellido: '', fecha_nacimiento: '', tipo_membresia: '' };

  constructor(private gymService: GymService) {}

  ngOnInit(): void {
    this.getMiembros();
  }

  getMiembros() {
    this.gymService.getMiembros().subscribe(data => {
      this.miembros = data;
    }, error => {
      console.error('Error al obtener miembros:', error);
    });
  }

  addMiembro() {
    this.gymService.addMiembro(this.nuevoMiembro).subscribe(() => {
      this.getMiembros();
      this.resetForm();
    }, error => {
      console.error('Error al agregar miembro:', error);
    });
  }

  cargarMiembro(miembro: any) {
    this.nuevoMiembro = { ...miembro }; // Cargar datos en el formulario
  }

  actualizarMiembro() {
    if (this.nuevoMiembro.miembro_id) {
      this.gymService.updateMiembro(this.nuevoMiembro).subscribe(() => {
        this.getMiembros();
        this.resetForm();
      }, error => {
        console.error('Error al actualizar miembro:', error);
      });
    }
  }

  eliminarMiembro(miembroId: number) {
    this.gymService.deleteMiembro(miembroId).subscribe(() => {
      this.getMiembros();
    }, error => {
      console.error('Error al eliminar miembro:', error);
    });
  }

  resetForm() {
    this.nuevoMiembro = { miembro_id: null, nombre: '', apellido: '', fecha_nacimiento: '', tipo_membresia: '' };
  }
}
