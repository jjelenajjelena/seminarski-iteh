import Axios from 'axios';
import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import { API } from '../constants';

export default class PrijavljivanjeStranica extends Component {

    constructor(props) {
        super(props);

        this.state = {
            ustanove: [],
            vakcine: []
        };

        this.getUstanove();
        this.getVakcine();

        console.log(this.state)
    }

    handleChange(e) {
        this.setState({ [e.target.name]: e.target.value });
    }

    handleImageChange(e) {
        this.setState({
            slikaShow: URL.createObjectURL(event.target.files[0]),
            slikaSend: event.target.files[0]
        })
    };

    handleSubmit(e) {
        e.preventDefault();
        let form_data = new FormData();
        form_data.append('slika', this.state.slikaSend, this.state.slikaSend.name);
        form_data.append('ustanovaId', this.state.ustanovaId);
        form_data.append('vakcinaId', this.state.vakcinaId);
        form_data.append('napomena', this.state.napomena);

        let url = API + '/prijave';
        axios.post(url, form_data, {
            headers: {
                'content-type': 'multipart/form-data'
            }
        })
            .then(res => {
                alert(res.data.poruka)
            })
    };

    getUstanove() {
        Axios.get(API + '/ustanove').then(res => {
            this.setState({ ustanove: res.data });
        });
    }

    getVakcine() {
        Axios.get(API + '/vakcine').then(res => {
            this.setState({ vakcine: res.data });
        });
    }
    render() {
        return (
            <div class="vh-100 d-flex justify-content-center align-items-center">
                <div class="main" id="prijava-box">
                    <form id="prijava-form">
                        <div class="form-group">
                            <label for="">Slika licne karte</label>
                            <br />
                            <input type="file"
                                id="slika"
                                accept="image/png, image/jpeg" onChange={this.handleImageChange.bind(this)} required>
                            </input>
                            <img height={'200px'} width={'300px'} src={this.state.slikaShow || 'https://via.placeholder.com/300x200'} />
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Izaberite ustanovu</label>
                                    <select class="form-control form-control-sm" onChange={this.handleChange.bind(this)} name="ustanovaId" id="ustanove-select">
                                        {this.state.ustanove.map(u => {
                                            return <option value={u.id} >{u.naziv_ustanova}</option>
                                        })}
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Izaberite vakcinu</label>
                                    <select class="form-control form-control-sm" onChange={this.handleChange.bind(this)} name="vakcinaId" id="vakcine-select">
                                        {this.state.vakcine.map(v => {
                                            return <option value={v.id} >{v.proizvodjac + ' [' + v.drzava_tag + ']'}</option>
                                        })}

                                    </select>
                                </div>

                            </div>
                        </div>




                        <div class="form-group">
                            <label for="napomena">Napomena</label>
                            <input type="text" onChange={this.handleChange.bind(this)} class="form-control" id="napomena" placeholder="Napomena za doktore." />
                        </div>

                        <button type="submit" onClick={this.handleSubmit.bind(this)} class="btn btn-primary btn-block">Prijavi se</button>
                    </form>

                </div>
            </div >
        );
    }
}

if (document.getElementById('prijavljivanje-stranica')) {
    ReactDOM.render(<PrijavljivanjeStranica />, document.getElementById('prijavljivanje-stranica'));
}
