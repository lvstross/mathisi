import React, { Component } from 'react';
import { Link, Route } from 'react-router-dom';

import Users from './components/Users';
import Posts from './components/Posts';

class App extends Component {
    render() {
        return (
            <div>
                <div>
                <Link to="/">Users</Link> | <Link to="/posts">Posts</Link>
                </div>
                <div>
                    <Route path="/" exact component={Users} />
                    <Route path="/posts" exact component={Posts} />
                </div>
            </div>
        );
    }
}

export default App;