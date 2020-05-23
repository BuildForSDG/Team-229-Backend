import React, { Component } from "react";
import ReactDOM from "react-dom";
import Axios from "axios";

class Example extends React.Component{

    constructor (props) {
        super(props);
        this.state={
            id: 0,
            name: "",
            email: "",
            gender: "",
            collectors: []
        };
    }

    componentDidMount(){
        this.getAll();
    }

    getAll(){
        Axios.get("http://localhost:8000/api")
        .then((res) => {
            this.setState({
                posts:res.data
            });
        });
    }
    getOne(collector){
        this.setState({
            id:collector.id,
            fname:collector.fname,
            email:collector.email,
            gender:collector.gender
        });
    }
    deleteCollector(id){
        Axios.delete("http://localhost:8000/api/${id}")
        .then((res) => {
            this.getAll();
        });
    }
    // updateCollector(e,id){
    //     Axios.put('http://localhost:8000/api/${id}')
    //     .then((res)=>{
    //         this.getAll();
    //     })
    // }
    submit(event,id){
        event.preventDefault();
        if(this.state.id === 0){
            Axios.post("http://localhost:8000/api", {email:this.state.email,fname:this.state.name,gender:this.state.gender})
            .then((res) => {
                this.getAll();
            })
        }else {
            Axios.put("http://localhost:8000/api/${id}", {email:this.state.email,fname:this.state.name,gender:this.state.gender})
            .then((res) => {
                this.getAll();
            });

        }
    }

    namechange(event){
        this.setState({
            name:event.target.value
        });
    }

    emailchange(event){
        this.setState({
            email:event.target.value
        });
    }

    genderchange(event){
        this.setState({
            gender:event.target.value
        });
    }

    render (){
    return (
            <div className="container">

                <div className="row justify-content-center">
                    <div className="section">
                        <div className="row">
                            <div className="col s4 push-s4">
                                <div className="card z-depth-3">
                                    <div className="card-title center #fff3e0 orange lighten-5">
                                        <span className="flow-text">Register</span>
                                        {/* <a class="btn-floating btn-small halfway-fab waves-effect waves-light red"><strong className="material-icons">+</strong></a> */}
            
                                    </div>

                                    <div className="card-content">
                                        <a className="btn-floating btn-small waves-effect waves-light red right #000000 black" href="#"><i className="material-icons">add</i></a>
                                        <h5 className="flow-text">Collector History</h5>
                                        <ul>
                                            <li>New Collector</li>
                                            <li>Collector Log</li>
                                            <li>Regions</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div className="col s4 pull-s5">
                                <div className="card z-depth-3">
                                    <div className="card-title center #fff3e0 orange lighten-5">
                                        <span className="flow-text">Questions</span>
                                        {/* <a class="btn-floating btn-small halfway-fab waves-effect waves-light red"><strong className="material-icons">+</strong></a> */}
            
                                    </div>

                                    <div className="card-content">
                                        <a className="btn-floating btn-small waves-effect waves-light red right #000000 black" href="#"><i className="material-icons">add</i></a>
                                        <h5 className="flow-text">Numeracy Tests</h5>
                                        <ul>
                                            <li>Multi Choice Questions</li>
                                            <li>Structured Questions</li>
                                            <li>Difficulty Levels</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div className="col s4 push-s1">
                                <div className="card z-depth-3">
                                    <div className="card-title center #fff3e0 orange lighten-5">
                                        <span className="flow-text">Veiw Statistics</span>
                                        {/* <a class="btn-floating btn-small halfway-fab waves-effect waves-light red"><strong className="material-icons">+</strong></a> */}
            
                                    </div>

                                    <div className="card-content">
                                        <a className="btn-floating btn-small waves-effect waves-light red right #000000 black" href="#"><i className="material-icons">add</i></a>
                                        <h5 className="flow-text">Analytics</h5>
                                        <ul>
                                            <li>By Region</li>
                                            <li>By Gender</li>
                                            <li>Exports CSV &amp; PDF </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                                {/* <div class="col s5 pull-s5">
                                    <div className="card">
                                    <span class="flow-text">Content 4</span>
                                    </div>
                                </div> */}
                        </div>
                    </div>
                        
                    <div className="section">
                        <div className="col-md-6">
                            <table className="highlight responsive-table">
                                <thead>
                                    <tr className="#fb8c00 orange darken-1">
                                        <td className="flow-text center" colSpan="6">
                                            <span className="material-icons">
                                                library_books
                                            </span> Current Data Collectors
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>#</td>
                                        <td>Name</td>
                                        <td>Email</td>
                                        <td>Gender</td>
                                        <td>Edit</td>
                                        <td>Delete</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    {this.state.collectors.map[(collector) =>
                                    <tr key={collector.id}>
                                    <td>{collector.fname}</td>
                                    <td>{collector.email}</td>
                                    <td>{collector.gender}</td>
                                    <td>
                                        <button onClick={(e) => this.getOne(collector)} className="waves-effect waves-light btn" href="#">Edit</button>
                                    </td>
                                    <td>
                                        <button onClick={(e) => this.deleteCollector(collector.id)}  className="waves-effect waves-light btn" href="#">Delete</button>
                                    </td>
                                    </tr>
                                    ]}
                                </tbody>
                            </table>
                           
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}
export default Example;

if (document.getElementById("example")) {
    ReactDOM.render(<Example />, document.getElementById("example"));
}
