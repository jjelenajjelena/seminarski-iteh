import Axios from 'axios';
import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import QrKodModal from '../komponente/QrKodModal';

export default class MojaPrijava extends Component {

    constructor(props) {
        super(props);

        this.state = {
            prijava: {
                doktor: {},
                pacijent: {},
                ustanova: {},
                vakcina: {}
            }
        };
        this.getMojaPrijava();
    }

    getMojaPrijava() {
        Axios.get('http://127.0.0.1:8000/api/prijave/moja').then(
            (res) => {
                this.setState({ prijava: res.data.prijava })
            }
        )
    }


    formirajDatum(timestamp) {
        const date = new Date(timestamp * 1000);
        return date.getDate() +
            "/" + (date.getMonth() + 1) +
            "/" + date.getFullYear() +
            " " + date.getHours() +
            ":" + (date.getMinutes() < 10 ? '0' + date.getMinutes() : date.getMinutes())
    }

    render() {
        return (
            this.state.prijava ? <div className="container">
                <div className="row justify-content-center">

                    <div class="col-12">
                        <div class="card">
                            <img class="card-img-top" style={{ height: '200px' }} src={`http://127.0.0.1:8000/storage/${this.state.prijava.slika_licne_karte}`} alt={this.state.prijava.jmbg} />

                        </div>
                    </div>

                </div>
                <div className="row">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Vase informacije: </h5>
                                <p class="card-text"><b>Ime i Prezime:</b> {this.state.prijava.pacijent.name}</p>
                                <p class="card-text"><b>Jmbg:</b> {this.state.prijava.pacijent.jmbg}</p>
                            </div>
                        </div>
                    </div>
                    <div className="col-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Informacije o doktoru: </h5>
                                <p class="card-text"><b>Ime i Prezime:</b> {this.state.prijava.doktor.name}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div className="row">
                    <div className="col">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Informacije o prijavi: </h5>
                                <div className="row">
                                    <div className="col">

                                        <p class="card-text"><b>Vreme:</b> {this.formirajDatum(this.state.prijava.zakazano_u)}</p>
                                        <p class="card-text"><b>Mesto:</b> {this.state.prijava.ustanova.naziv_ustanova}</p>
                                    </div>
                                    <div className="col">
                                        <p class="card-text"><b>Vakcina:</b> {this.state.prijava.vakcina.proizvodjac}</p>
                                        <p class="card-text"><b>QR Kod:</b> <QrKodModal src={`https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=http://127.0.0.1:8000/jedna-prijava/${this.state.prijava.id}`} /></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> :

                <div class="d-flex justify-content-center h-100 align-items-center">
                    <h1>Niste prijavljeni za vakcinaciju, prijavite se <a href="http://127.0.0.1:8000/prijavljivanje">ovde</a>.</h1>
                </div>
        );
    }
}

if (document.getElementById('moja-prijava')) {
    ReactDOM.render(<MojaPrijava />, document.getElementById('moja-prijava'));
}
