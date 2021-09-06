import Axios from 'axios';
import React, { Component } from 'react';
import ReactDOM from 'react-dom';

export default class DoktorObaveze extends Component {

    constructor(props) {
        super(props);

        this.state = {
            prijave: [],
        };

        this.getMojeObaveze();

    }


    getMojeObaveze() {
        Axios.get('http://127.0.0.1:8000/api/prijave/moje').then(res => {
            this.setState({ prijave: res.data.prijave });
        });
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
            this.state.prijave.length ? <div className="container">
                <div className="row">
                    {this.state.prijave.map(prijava => {

                        return <div class="col-4">
                            <div class="card">
                                <img class="card-img-top" style={{ height: '200px' }} src={`http://127.0.0.1:8000/storage/${prijava.slika_licne_karte}`} alt="Card image cap" />
                                <div class="card-body">
                                    <h5 class="card-title">{prijava.pacijent.name}</h5>
                                    <p class="card-text">Jmbg: {prijava.pacijent.jmbg}</p>
                                    <p class="card-text">Vreme: {this.formirajDatum(prijava.zakazano_u)}</p>
                                </div>
                            </div>
                        </div>
                    })}
                </div>
            </div> :

                <div class="d-flex justify-content-center h-100 align-items-center">
                    <h1>Mozete da odmorite, nemate obaveze</h1>
                </div>

        );
    }
}

if (document.getElementById('doktor-obaveze')) {
    ReactDOM.render(<DoktorObaveze />, document.getElementById('doktor-obaveze'));
}
