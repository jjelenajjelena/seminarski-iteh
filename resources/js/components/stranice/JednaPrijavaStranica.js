import Axios from 'axios';
import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import QrKodModal from '../komponente/QrKodModal';

export default class JednaPrijava extends Component {

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
            <div className="container">
                <div className="row justify-content-center">

                    <div class="col-12">
                        <div class="card">
                            <img class="card-img-top" style={{ height: '200px' }} src={`http://127.0.0.1:8000/storage/${this.props.prijava.slika_licne_karte}`} alt={this.props.prijava.jmbg} />

                        </div>
                    </div>

                </div>
                <div className="row">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Vase informacije: </h5>
                                <p class="card-text"><b>Ime i Prezime:</b> {this.props.prijava.pacijent.name}</p>
                                <p class="card-text"><b>Jmbg:</b> {this.props.prijava.pacijent.jmbg}</p>
                            </div>
                        </div>
                    </div>
                    <div className="col-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Informacije o doktoru: </h5>
                                <p class="card-text"><b>Ime i Prezime:</b> {this.props.prijava.doktor.name}</p>
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

                                        <p class="card-text"><b>Vreme:</b> {this.formirajDatum(this.props.prijava.zakazano_u)}</p>
                                        <p class="card-text"><b>Mesto:</b> {this.props.prijava.ustanova.naziv_ustanova}</p>
                                    </div>
                                    <div className="col">
                                        <p class="card-text"><b>Vakcina:</b> {this.props.prijava.vakcina.proizvodjac}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        );
    }
}

if (document.getElementById('jedna-prijava')) {
    const jednaPrijavaElement = document.getElementById("jedna-prijava");
    const prijava = JSON.parse(jednaPrijavaElement.dataset.prijava);
    console.log(prijava);
    ReactDOM.render(<JednaPrijava prijava={prijava} />, document.getElementById('jedna-prijava'));
}
