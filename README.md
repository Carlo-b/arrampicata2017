# (RIVOLTO AI MEMBRI DEL GRUPPO)
# COSA/COME AGGIUNGERE CODICE 

Per ogni pagina che volete aggiungere dovete creare un controller all'interno di `application/controller/` in cui mettere il metodo per mostrare la vista (ovvero un metodo index) ed eventuali metodi per le azioni che si possono compiere nella pagina, questi metodi possono comunicare con model.php e usare i metodi del model.php. Se volete aggiungere metodi per comunicare col database dovete aggiungerli al model, NON al controller (dal controller dovrete chiamare i metodi del model). Infine le viste vere e proprie sono altri file PHP (e HTML) all'interno di `application/view/`. 
