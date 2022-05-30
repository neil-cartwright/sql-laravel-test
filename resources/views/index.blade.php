<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css"
        />
        <title>SQL Laravel Test</title>
    </head>
    <body>
        <section class="section">
            <div class="container">
                <h1 class="title is-size-3">SQL Laravel Test</h1>
                <hr />
                <div class="columns">
                    <div class="column is-2">
                        <h1 class="title is-size-6">Teams</h1>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Users</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($teams as $team)
                                <tr>
                                    <td>{{ $team->id }}</td>
                                    <td>{{ $team->name}}</td>
                                    <td>{{ $team->users->count() }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="column is-4">
                        <h1 class="title is-size-6">Users</h1>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Teams (from Pivot)</th>
                                    <th>Roles</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name}}</td>
                                    <td>
                                        <!-- nested foreach -->
                                        @foreach($user->teams as $team)
                                        <span>{{ $team->name }}</span
                                        >, @endforeach
                                    </td>
                                    <td>@foreach($user->roles as $role)<span>{{ $role->name }}</span>, @endforeach</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="column is-2">
                        <h1 class="title is-size-6">Roles</h1>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Users</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($roles as $role)
                                <tr>
                                    <td>{{ $role->id }}</td>
                                    <td>{{ $role->name}}</td>
                                    <td>{{$role->users()->count()}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="column is-2">
                        <h1 class="title is-size-6">Permissions</h1>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($permissions as $p)
                                <tr>
                                    <td>{{ $p->id }}</td>
                                    <td>{{ $p->name}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- end of columns  -->

                <hr />
                <!-- pivots -->
                <div class="columns is-multiline">
                    <div class="column is-12 content">
                        <h1 class="title is-5">Pivot tables</h1>
                        <h2 class="title is-6">Team_User</h2>
                        <p>
                            This is a pivot table. We use the hasMany
                            relationship on both Team.php and User.php. Laravel
                            assumes a pivot table called Team_User which has
                            been created via a Migration.
                        </p>
                        <p>
                            You can attach User 33 (Jo) to a Team with <br />
                            <code
                                >$team = Team::find(23); // team 23 is 'Nurses'
                                <br />
                                $team->users()->attach(33);</code
                            >
                        </p>
                        <p>
                            You can add a Team to a User with
                            <code
                                >$user = User::find(31); // Taylor
                                <br />$user->teams()->attach(21); // Creates
                                relationship between Taylor and Prescriber in
                                the Team_User table.
                            </code>
                        </p>
                    </div>
                    <div class="column is-4">
                        <h4 class="title is-6">Actual data</h4>
                        <table class="table has-text-centered">
                            <thead>
                                <tr>
                                    <th>Team ID</th>
                                    <th>User ID</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user) @foreach($user->teams
                                as $team)
                                <tr>
                                    <td>
                                        {{ $team->id }}
                                    </td>
                                    <td>
                                        {{ $user->id }}
                                    </td>
                                </tr>
                                @endforeach @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="column is-4">
                        <h4 class="title is-size-6">Readable data</h4>
                        <table class="table has-text-centered">
                            <thead>
                                <tr>
                                    <th>Composite Key</th>
                                    <th>Team Name</th>
                                    <th>User Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user) @foreach($user->teams
                                as $team)
                                <tr>
                                    <td>
                                        <span>{{$team->pivot->team_id
                                        }}</span
                                        ><span>{{$team->pivot->user_id}}</span>
                                    </td>
                                    <td>
                                        {{ $team->name}}
                                    </td>
                                    <td>
                                        {{$user->name}}
                                    </td>
                                </tr>
                                @endforeach @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="columns">
                    <div class="column is-12">
                        <h1 class="title is-size-6">Role_User</h1>
                        <p>Lists the users with their associated roles</p>
                        <table class="table has-text-centered">
                            <thead>
                                <tr>
                                    <th>User Name</th>
                                    <th>Teams</th>
                                    <th>Role Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($roles as $role) @foreach($role->users
                                as $user)
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>@foreach($user->teams as $teams)
                                        <span>{{ $teams->name }},</span>
                                        @endforeach</td>
                                    <td>{{$role->name}}</td>
                                </tr>
                                @endforeach @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="columns">
                    <div class="column is-12">
                        <div class="notification content">
                            <p>Tasks:</p>
                            <p>
                                Provide an efficient query that, given a
                                certain ...</p><p> a. ... team id, shows all the roles
                                in the database and how many users are assigned
                                each role.</p><p> b. ... user id, shows all the teams
                                in the database and what roles they have in each
                                team.</p> <p>c. ... user id, shows all the teams and
                                the roles in the database and whether or not the
                                user belongs to that team-role.</p>  
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>
