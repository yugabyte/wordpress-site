<?php
/**
 * Current Job Openings Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'lever_jobs-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'lever_jobs';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and adding defaults.
$heading = get_field('heading');
$intro = get_field('intro');
$deep_anchor = get_field('deep_anchor');

?>
<div id="<?php echo esc_attr($id); ?>" class="content_section <?php echo esc_attr($className); ?>">
    <div id="<?php echo $deep_anchor; ?>" class="content_section_inner full tall_pad">
        <div class="grid nopadding large_padding_bottom">
            <div class="col-8-12 push-2-12 mobile-col-1-1 nopadding">
            <?php
            if( $heading ) {
                echo '<h2 class="lined_left">'.$heading.'</h2>';
            }
            if( $intro ) {
                echo $intro;
            }
            ?>
            </div>
        </div>
        <div class="grid nopadding">
            <div class="col-8-12 push-2-12 mobile-col-1-1 nopadding">
                
                <div id="new-list" class="grid nopadding">
                    <div class="col-4-12 mobile-col-1-1 nopadding">
                        <div id="lever-jobs-filter">
                            <div class="jobs_filter_wrap">
                                <h3>Filter by Location</h3>
                                <select class="lever-jobs-filter-locations">
                                    <option value="" disabled selected>All</option>
                                </select>
                            </div>
                            <div class="jobs_filter_wrap">
                                <h3>Filter by Department</h3>
                                <select class="lever-jobs-filter-departments">
                                    <option value="" disabled selected>All</option>
                                </select>
                            </div>
                            <div class="jobs_filter_wrap">
                                <h3>Filter by Team</h3>
                                <select class="lever-jobs-filter-teams">
                                    <option value="" disabled selected>All</option>
                                </select>
                            </div>
                                
                            
                            <!--<select class="lever-jobs-filter-work-types">
                                <option value="" disabled selected>Filter by work type</option>
                            </select>-->
                            <a id="lever-clear-filters" class="btn" style="display: none;">Clear filters</a>
                        </div>
                    </div>
                    <div class="col-8-12 mobile-col-1-1 nopadding">
                
                        <div>
                            <ul class="list"></ul>
                            <div id="lever-no-results" style="display: none;">No results</div>
                        </div>
                
                        <div id="lever_jobs_cont"></div>
                
                        <script type='text/javascript'>
                        window.loadLeverJobs = function (options) {
                    
                            //Checking for potential Lever source or origin parameters
                            var pageUrl = window.location.href;
                            var leverParameter = '';
                            var trackingPrefix = '?lever-';
                    
                            //options.accountName = options.accountName.toLowerCase();
                    
                            // Define the container where we will put the content (or put in the body)
                            //var jobsContainer = document.getElementById("lever-jobs-container") || document.body;
                    
                            if( pageUrl.indexOf(trackingPrefix) >= 0){
                                // Found Lever parameter
                                var pageUrlSplit = pageUrl.split(trackingPrefix);
                                leverParameter = '?lever-'+pageUrlSplit[1];
                            }
                    
                            var htmlTagsToReplace = {
                                    '&': '&amp;',
                                    '<': '&lt;',
                                    '>': '&gt;'
                                };
                            function replaceTag(tag) {
                                return htmlTagsToReplace[tag] || tag;
                            }
                    
                            //For displaying titles that contain brackets in the 'append' function
                            function sanitizeForHTML(str) {
                                if (typeof str == 'undefined' ) {
                                    return '';
                                }
                                return str.replace(/[&<>]/g, replaceTag);
                            }
                    
                            //Functions for checking if the variable is unspecified and removing script tags + null check
                            //For making class names from department and team names
                            function sanitizeAttribute(string) {
                                if (string == '' || typeof string == 'undefined' ) {
                                    return 'uncategorized';
                                }
                                string = sanitizeForHTML(string);
                                return string.replace(/\s+/ig, "");
                            }
                    
                            var jobsContainer = document.getElementById("lever_jobs_cont");
                            var jobsurl = 'https://api.lever.co/v0/postings/yugabyte?group=team&mode=json';
                    
                            //Create an object ordered by department and team
                            function createJobs(responseData) {
                                if (!responseData) return;
                        
                                //Older versions of IE might not interpret the data as a JSON object
                                if(typeof responseData === "string") {
                                    responseData = JSON.parse(responseData);
                                }
                        
                                var content = "";
                                var groupedPostings = [];
                        
                                for(var i = 0; i < responseData.length; i++) {
                                    if (!responseData[i]) continue;
                                    if (!responseData[i].postings) continue;
                                    if (!(responseData[i].postings.length > 0)) continue;
                            
                                    var title = sanitizeForHTML(responseData[i].title || 'Uncategorized');
                                    var titlesanitizeAttribute = sanitizeAttribute(title);
                            
                                    for (j = 0; j < responseData[i].postings.length; j ++) {
                                        var posting = responseData[i].postings[j];
                                        var team = (posting.categories.team || 'Uncategorized' );
                                        var teamsanitizeAttribute = sanitizeAttribute(team);
                                        var department = (posting.categories.department || 'Uncategorized' );
                                        var departmentsanitizeAttribute = sanitizeAttribute(department);
                                        var link = posting.hostedUrl+leverParameter;
                                
                                        function findDepartment(element) {
                                            return element.department == departmentsanitizeAttribute;
                                        }
                                
                                        if (groupedPostings.findIndex(findDepartment) === -1) {
                                    
                                            newDepartmentToAdd = {department : departmentsanitizeAttribute, departmentTitle: department, teams : [ {team: teamsanitizeAttribute, teamTitle: team, postings : []} ] };
                                            groupedPostings.push(newDepartmentToAdd);
                                    
                                        } else {
                                    
                                            departmentIndex = groupedPostings.findIndex(findDepartment);
                                            newTeamToAdd = {team: teamsanitizeAttribute, teamTitle: team, postings : []};
                                    
                                            if (groupedPostings[departmentIndex].teams.map(function(o) { return o.team; }).indexOf(teamsanitizeAttribute) === -1) {
                                                groupedPostings[departmentIndex].teams.push(newTeamToAdd);
                                            }
                                
                                        }
                                
                                        function findTeam(element) {
                                            return element.team == teamsanitizeAttribute;
                                        }
                                
                                        departmentIndex = groupedPostings.findIndex(findDepartment);
                                        teamIndex = groupedPostings[departmentIndex].teams.findIndex(findTeam);
                                        groupedPostings[departmentIndex].teams[teamIndex].postings.push(posting);
                            
                                    }
                                }
                        
                                // Sort by department
                                /*groupedPostings.sort(function(a, b) {
                                    var departmentA=a.department.toLowerCase(), departmentB=b.department.toLowerCase()
                            
                                    if (departmentA < departmentB)
                                        return -1
                                    if (departmentA > departmentB)
                                        return 1
                                    return 0
                                });*/
                        
                                for(var i = 0; i < groupedPostings.length; i++) {
                            
                                    // If there are no departments used, there is only one "unspecified" department, and we don't have to render that.
                                    if (groupedPostings.length >= 2) {
                                        var haveDepartments = true;
                                    };
                            
                                    /*if (haveDepartments) {
                                        content += '<section class="lever-department" data-department="' + groupedPostings[i].departmentTitle + '"><h3 class="lever-department-title">' + sanitizeForHTML(groupedPostings[i].departmentTitle) + '</h3>';
                                    };*/
                            
                                    for (j = 0; j < groupedPostings[i].teams.length; j ++) {
                                
                                        //content += '<ul class="lever-team" data-team="' + groupedPostings[i].teams[j].teamTitle + '"><li><h4 class="lever-team-title">' + sanitizeForHTML(groupedPostings[i].teams[j].teamTitle) + '</h4><ul>';
                                
                                        for (var k = 0; k < groupedPostings[i].teams[j].postings.length; k ++) {
                                            content += '<li class="lever-job" data-department="' + groupedPostings[i].departmentTitle +'" data-team="' + groupedPostings[i].teams[j].postings[k].categories.team + '" data-location="' + groupedPostings[i].teams[j].postings[k].categories.location + '"data-work-type="' + groupedPostings[i].teams[j].postings[k].categories.commitment + '">';
                                            content += '<a class="lever-job-title" href="' + groupedPostings[i].teams[j].postings[k].hostedUrl + '">';
                                            content += '<h4>' + sanitizeForHTML(groupedPostings[i].teams[j].postings[k].text) + '</h4>';
                                            content += '<span class="team">' + (sanitizeForHTML(groupedPostings[i].teams[j].postings[k].categories.team) || '') + '</span>';
                                            content += ' | ';
                                            content += '<span class="lever-job-tag">' + (sanitizeForHTML(groupedPostings[i].teams[j].postings[k].categories.location) || '') + '</span>';
                                                                                         
                                            content += '</a></li>';
                                        }
                                
                                        //content += '</ul></li></ul>';
                                    }
                            
                                    /*if (haveDepartments) {
                                        content += '</section>';
                                    };*/
                                }
                        
                                content += '</ul>';
                                jobsContainer.innerHTML = content;
                                window.dispatchEvent(new Event('leverJobsRendered'));
                            }
                    
                            var request = new XMLHttpRequest();
                            request.open('GET', jobsurl, true);
                            request.responseType = "json";
                    
                            request.onload = function() {
                                if (request.status == 200) {
                                    createJobs(request.response);
                                } else {
                                    console.log("Error fetching jobs.");
                                    jobsContainer.innerHTML = "<p class='lever-error'>Error fetching jobs.</p>";
                                }
                            };
                    
                            request.onerror = function() {
                                console.log("Error fetching jobs.");
                                jobsContainer.innerHTML = "<p class='lever-error'>Error fetching jobs.</p>";
                            };
                    
                            request.send();
                        };
                
                        window.loadLeverJobs(window.leverJobsOptions);
                
                
                        ////////////////////////////////////////////////
                
                        window.addEventListener('leverJobsRendered', function() {
                    
                            (function($) {
                    
                                $(".lever-job").clone().appendTo("#new-list ul");
                    
                                var options = {
                                    valueNames: [
                                        'lever-job-title',
                                        { data: ['location'] },
                                        { data: ['department'] },
                                        { data: ['team'] },
                                        //{ data: ['work-type'] }
                                    ]
                                };
                    
                                var jobList = new List('new-list', options);
                    
                                console.log("joblist", jobList);
                    
                                var locations = [];
                                var departments = [];
                                var teams = [];
                                //var workTypes = [];
                    
                                for (var i = 0; i < jobList.items.length; i++) {
                                    var item = jobList.items[i]._values;
                                    var location = item.location;
                        
                                    if(jQuery.inArray(location, locations) == -1) {
                                        locations.push(location);
                                    }
                        
                                    var department = item.department;
                        
                                    if(jQuery.inArray(department, departments) == -1) {
                                        departments.push(department);
                                    }
                        
                                    var team = item.team;
                        
                                    if(jQuery.inArray(team, teams) == -1) {
                                        teams.push(team);
                                    }
                        
                                    /*var workType = item["work-type"];
                        
                                    if(jQuery.inArray(workType, workTypes) == -1) {
                                        workTypes.push(workType);
                                    }*/
                                }
                    
                                locations.sort();
                                departments.sort();
                                teams.sort();
                                //workTypes.sort();
                    
                                for (var j = 0; j < locations.length; j++ ) {
                                    $( "#lever-jobs-filter .lever-jobs-filter-locations").append('<option>' + locations[j] + '</option>');
                                }
                                for (var j = 0; j < departments.length; j++ ) {
                                    $( "#lever-jobs-filter .lever-jobs-filter-departments").append('<option class=department>' + departments[j] + '</option>');
                                }
                                for (var j = 0; j < teams.length; j++ ) {
                                    $( "#lever-jobs-filter .lever-jobs-filter-teams").append('<option>' + teams[j] + '</option>');
                                }
                                /*for (var j = 0; j < workTypes.length; j++ ) {
                                    $( "#lever-jobs-filter .lever-jobs-filter-work-types").append('<option>' + workTypes[j] + '</option>');
                                }*/
                    
                                function showFilterResults() {
                                    $('#new-list .list').show();
                                    $('#lever_jobs_cont').hide();
                                }
                                function hideFilterResults() {
                                    $('#new-list .list').hide();
                                    $('#lever_jobs_cont').show();
                                }
                    
                                // Show the unfiltered list by default
                                hideFilterResults();
                    
                                $('#lever-jobs-filter select').change(function(){
                        
                                    var selectedFilters = {
                                        location: $('#lever-jobs-filter select.lever-jobs-filter-locations').val(),
                                        department: $('#lever-jobs-filter select.lever-jobs-filter-departments').val(),
                                        team: $('#lever-jobs-filter select.lever-jobs-filter-teams').val(),
                                        //'work-type': $('#lever-jobs-filter select.lever-jobs-filter-work-types').val(),
                                    }
                        
                                    //Filter the list
                                    jobList.filter(function(item) {
                                        var itemValue = item.values();
                            
                                        // Check the itemValue against all filter properties (location, team, work-type).
                                        for (var filterProperty in selectedFilters) {
                                            var selectedFilterValue = selectedFilters[filterProperty];
                                
                                            // For a <select> that has no option selected, JQuery's val() will return null.
                                            // We only want to compare properties where the user has selected a filter option,
                                            // which is when selectedFilterValue is not null.
                                            if (selectedFilterValue !== null) {
                                                if (itemValue[filterProperty] !== selectedFilterValue) {
                                                    // Found mismatch with a selected filter, can immediately exclude this item.
                                                    return false;
                                                }
                                            }
                                        }
                                        // This item passes all selected filters, include this item.
                                        return true;
                                    });
                        
                                    //Show the 'no results' message if there are no matching results
                                    if (jobList.visibleItems.length >= 1) {
                                        $('#lever-no-results').hide();
                                    } else {
                                        $('#lever-no-results').show();
                                    }
                        
                                    console.log("filtered?", jobList.filtered);
                        
                                    $('#lever-clear-filters').show();
                        
                                    //Show the list with filtered results
                                    showFilterResults();
                                });
                    
                                $('#new-list').on('click', '#lever-clear-filters', function() {
                                    console.log("clicked clear filters");
                        
                                    jobList.filter();
                        
                                    console.log("jobList filtered?", jobList.filtered);
                        
                                    if (jobList.filtered == false) {
                                        hideFilterResults();
                                    }
                                    $('#lever-jobs-filter select').prop('selectedIndex',0);
                                    $('#lever-clear-filters').hide();
                                    $('#lever-no-results').hide();
                                });
                    
                                // Showing/hiding search results when the search box is empty
                                $('#new-list').on('input', '#lever-jobs-search', function() {
                                    if($(this).val().length || jobList.filtered == true) {
                                        showFilterResults();
                            
                                        if (jobList.visibleItems.length >= 1) {
                                            $('#lever-no-results').hide();
                                        } else {
                                            $('#lever-no-results').show();
                                        }
                        
                                    } else {
                            
                                        hideFilterResults();
                                        $('#lever-no-results').hide();
                                    }
                                });
                
                            }(jQuery));
                
                        });
                
                        </script>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>