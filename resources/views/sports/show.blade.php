@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Results</div>

                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Country</th>
                                    <th scope="col">Gold</th>
                                    <th scope="col">Silver</th>
                                    <th scope="col">Bronze</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>United States of America</th> <!-- {{ $country->name }}-->
                                    <td>39</td> <!-- {{ $country->firstCount }} -->
                                    <td>41</td> <!-- {{ $country->secondCount }} -->
                                    <td>33</td> <!-- {{ $country->thirdCount }} -->
                                </tr>
                                <tr>
                                    <th>France</th>
                                    <td>10</td>
                                    <td>12</td>
                                    <td>14</td>
                                </tr>
                                <tr>
                                    <th>Germany</th>
                                    <td>10</td>
                                    <td>11</td>
                                    <td>16</td>
                                </tr>
                                <tr>
                                    <th>Poland</th>
                                    <td>4</td>
                                    <td>5</td>
                                    <td>5</td>
                                </tr>
                                <tr>
                                    <th>Norway</th>
                                    <td>4</td>
                                    <td>2</td>
                                    <td>2</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
